<?php
App::uses('AppController', 'Controller');
App::uses('RoutineController', 'Routine.Controller');

class ArticlesController extends RoutineController {

    public $uses = array(
        'Article',
        'AuthorStatus',
        'PublisherStatus',
        'CoauthorStatus',
        'DocumentTemplate',
        'PageContent',
    );
    public $components = array(
        'Search.Prg',
        'Filebinder.Ring',
        'Paginator' => array('limit' => 50),
    );

    public $presetVars = array(
        array('field' => 'keyword', 'type' => 'value', 'encode' => true),
        array('field' => 'author_status_id', 'type' => 'value'),
        array('field' => 'publisher_status_id', 'type' => 'value'),
        array('field' => 'coauthor_status_id', 'type' => 'value'),
        array('field' => 'author_policy', 'type' => 'value'),
        array('field' => 'file_status', 'type' => 'value'),
        array('field' => 'publisher_embargo_period_complete', 'type' => 'value'),
    );

    /**
     * beforeFilter
     *
     */
    public function beforeFilter(){
        parent::beforeFilter();

        $this->Auth->allow(array(
                'register',
                'register_ok_and_upload',
                'register_upload_complete',
                'register_ok_complete',
                'register_ng_complete',
            ));

        // Security
        if ($this->action === 'index') {
            $this->Security->csrfCheck = false;
        }

        $this->Article->hasAll();

        $this->set(array(
                'templates' => $this->DocumentTemplate->find('list'),
            ));
    }

    /**
     * index
     *
     */
    public function index(){
        $this->Prg->commonProcess();
        $conditions = $this->Article->parseCriteria($this->passedArgs);

        // デフォルトの条件設定
        if (
            empty($conditions['Article.author_status_id'])
            && empty($conditions['Article.publisher_status_id'])
            && empty($conditions['Article.coauthor_status_id'])
        ) {
            $authorOpenStatus = $this->AuthorStatus->findStatuses('list', STATUS_TYPE_OPEN);
            $publisherOpenStatus = $this->PublisherStatus->findStatuses('list', STATUS_TYPE_OPEN);
            $coauthorOpenStatus = $this->CoauthorStatus->findStatuses('list', STATUS_TYPE_OPEN);
            $conditions[] = array('OR' => array(
                    'Article.author_status_id' => array_keys($authorOpenStatus),
                    'Article.publisher_status_id' => array_keys($publisherOpenStatus),
                    'Article.coauthor_status_id' => array_keys($coauthorOpenStatus),
                ));
        }

        $this->Article->setOpenStatuses();

        // OPEN系のステータスの案件数
        $articlesOpenCount = $this->Article->findArticlesOpenCount();

        // OPEN系で著者許諾可否が登録されている案件数
        $articlesAuthorPolicyCount = $this->Article->findArticlesAuthorPolicyCount();

        // OPEN系で本文アップロード済みの案件数
        $articlesFileUploadedCount = $this->Article->findArticlesFileUploadedCount();

        // OPEN系でエンバーゴ期間満了の案件数
        $articlesEmbargoCompleteCount = $this->Article->findArticlesEmbargoCompleteCount();

        $this->set(compact(
                'articlesOpenCount',
                'articlesAuthorPolicyCount',
                'articlesFileUploadedCount',
                'articlesEmbargoCompleteCount'
            ));

        // 著者許諾に「許諾可否回答済み」を追加
        $author_policies = Configure::read('Article.author_policies');
        $author_policies[ARTICLE_AUTHOR_POLICY_NOT_NULL] = __('Author Policy Not Null');
        $this->set(array(
                'author_policies' => $author_policies,
            ));

        $this->set(array(
                'articles' => $this->Paginator->paginate($conditions),
            ));
    }

    /**
     * edit
     *
     * @param $id
     */
    public function edit($id){
        $this->_edit($id);
        $article = $this->Article->view($id);
        $this->set(compact('article'));
    }

    /**
     * _editRedirect
     *
     */
    protected function _editRedirect($id){
        $this->redirect(array('action' => 'view', $id));
    }

    /**
     * upload
     *
     */
    public function upload($id){
        $this->Ring->bindUp();
        $this->Article->setValidation('upload');
        $this->_edit($id);
        $this->Ring->bindDown();
        $article = $this->Article->view($id);
        $this->set(compact('article'));
    }

    /**
     * register
     *
     */
    public function register($hash = null){
        $article = $this->Article->findByHash($hash);
        if (empty($article)) {
            throw new NotFoundException();
        }
        $this->Transition->setData('register', array());
        $contents = $this->PageContent->findContents();
        $this->set(compact('hash', 'article', 'contents'));
    }

    /**
     * register_ok_and_upload
     *
     * @param $hash
     */
    public function register_ok_and_upload($hash = null){
        $this->Ring->bindUp();
        $this->Transition->checkPrev(array('register'));
        $article = $this->Article->findByHash($hash);
        if (empty($article)) {
            throw new NotFoundException();
        }
        $contents = $this->PageContent->findContents();
        $id = $article['Article']['id'];

        $this->Article->setAuthorPolicy($id, ARTICLE_AUTHOR_POLICY_OK_AND_UPLOAD);
        try {

            // バリデーションの調整
            $this->Article->setValidation('register_upload');
            for ($i = 1; $i <= 5; $i++) {
                if (!empty($article['Article']['file' . $i])) {
                    $this->Article->validate['file1'] = array('file');
                }
            }
            $result = $this->{$this->modelClass}->edit($id, $this->request->data);
            if ($result === true) {
                $this->Session->setFlash(
                    __('The %s has been uploaded', __('File')),
                    $this->setFlashElement['success'],
                    $this->setFlashParams['success']);
                $this->Transition->redirect(array('action' => 'register_upload_complete', $hash));
            } else {
                $this->request->data = $result;
            }
        } catch (ValidationException $e) {
            $this->Session->setFlash($e->getMessage(),
                $this->setFlashElement['error'],
                $this->setFlashParams['error']);
        } catch (OutOfBoundsException $e) {
            $this->Session->setFlash($e->getMessage(),
                $this->setFlashElement['error'],
                $this->setFlashParams['error']);
        }

        $this->set(compact('hash', 'article', 'contents'));
        $this->Ring->bindDown();
    }

    /**
     * register_upload_complete
     *
     * @param $hash = null
     */
    public function register_upload_complete($hash = null){
        $this->Transition->checkPrev(array('register_ok_and_upload'));
        $article = $this->Article->findByHash($hash);
        if (empty($article)) {
            throw new NotFoundException();
        }
        $contents = $this->PageContent->findContents();
        $id = $article['Article']['id'];

        $this->__authorCommentUpdate($id, $hash);

        $this->set(compact('hash', 'article', 'contents'));
    }

    /**
     * register_ok_complete
     *
     * @param $hash = null
     */
    public function register_ok_complete($hash = null){
        $this->Transition->checkPrev(array('register'));
        $article = $this->Article->findByHash($hash);
        if (empty($article)) {
            throw new NotFoundException();
        }
        $id = $article['Article']['id'];
        $this->Article->setAuthorPolicy($id, ARTICLE_AUTHOR_POLICY_OK);

        $this->__authorCommentUpdate($id, $hash);

        $contents = $this->PageContent->findContents();
        $this->set(compact('hash', 'article', 'contents'));
    }

    /**
     * register_ng_complete
     *
     * @param $hash = null
     */
    public function register_ng_complete($hash = null){
        $this->Transition->checkPrev(array('register'));
        $article = $this->Article->findByHash($hash);
        if (empty($article)) {
            throw new NotFoundException();
        }
        $id = $article['Article']['id'];
        $this->Article->setAuthorPolicy($id, ARTICLE_AUTHOR_POLICY_NG);

        $this->__authorCommentUpdate($id, $hash);

        $contents = $this->PageContent->findContents();
        $this->set(compact('hash', 'article', 'contents'));
    }

    /**
     * __authorCommentUpdate
     *
     * @param $id, $hash
     */
    private function __authorCommentUpdate($id, $hash){
        try {
            $this->Article->setValidation('author_comment');
            $result = $this->Article->edit($id, $this->request->data);
            if ($result === true) {
                $this->Session->setFlash(
                    __('The %s has been created', __('Comment')),
                    $this->setFlashElement['success'],
                    $this->setFlashParams['success']);
                $this->Transition->redirect(array('action' => $this->action, $hash));
            } else {
                $this->request->data = $result;
            }
        } catch (ValidationException $e) {
            $this->Session->setFlash($e->getMessage(),
                $this->setFlashElement['error'],
                $this->setFlashParams['error']);
        } catch (OutOfBoundsException $e) {
            $this->Session->setFlash($e->getMessage(),
                $this->setFlashElement['error'],
                $this->setFlashParams['error']);
        }
    }

    /**
     * beforeRender
     *
     */
    public function beforeRender(){
        parent::beforeRender();

        $request_methods = Configure::read('Article.request_methods');
        $this->set(array(
                'language_isos' => Configure::read('Article.language_isos'),
                'language_iso639_2s' => Configure::read('Article.language_iso639_2s'),
                'publicationstatuses' => Configure::read('Article.publicationstatuses'),
                'peerrevieweds' => Configure::read('Article.peerrevieweds'),
                'type_niis' => Configure::read('Article.type_niis'),
                'textversions' => Configure::read('Article.textversions'),
                'publisher_request_methods' => $request_methods,
                'author_request_methods' => $request_methods,
                'coauthor_request_methods' => $request_methods,
                'coauthor_flgs' => Configure::read('Article.coauthor_flgs'),
                'author_coauthor_flgs' => Configure::read('Article.author_coauthor_flgs'),
                'author_statuses' => $this->AuthorStatus->find('list'),
                'publisher_statuses' => $this->PublisherStatus->find('list'),
                'coauthor_statuses' => $this->CoauthorStatus->find('list'),
            ));
    }
}