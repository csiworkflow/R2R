<?php
App::uses('RoutineModel', 'Routine.Model');

/**
 * Article Model
 *
 */
class Article extends RoutineModel {

    public $displayField = 'title';
    public $actsAs = array(
        'Search.Searchable',
        'Containable',
        'Yacsv.Importer',
        'Filebinder.Bindable' => array(
            'tmpPath' => CACHE,
            'filePath' => FILE_PATH,
        ),
    );

    public $order = array('Article.id DESC'); // デフォルトのソート条件

    public $bindFields = array(
        array('field' => 'file1',),
        array('field' => 'file2',),
        array('field' => 'file3',),
        array('field' => 'file4',),
        array('field' => 'file5',),

    );

    public $belongsTo = array(
        'AuthorStatus',
        'PublisherStatus',
        'CoauthorStatus',
    );

    public $validate = array(
        'hash' => array('required', 'notempty', 'unique'),
        'file_count' => array('required', 'notempty', 'numeric'),
        'title' => array('required', 'notempty'),
        'author_status_id' => array('required', 'notempty'),
        'publisher_status_id' => array('required', 'notempty'),
        'coauthor_status_id' => array('required', 'notempty'),
        'date_issued' => array('required', 'notempty'),
        'contributor_author' => array('required', 'notempty'),
        'identifier_doi' => array('unique'),
        'identifier_issn' => array('issn', 'unique_issn'),
        'language_iso' => array('language_iso'),
        'language_iso639_2' => array('language_iso639_2'),
        'publicationstatus' => array('publicationstatus'),
        'peerreviewed' => array('peerreviewed'),
        'type_nii' => array('type_nii'),
        'textversion' => array('textversion'),
        'publisher_open_file_version' => array('publisher_open_file_version'),
        'publisher_policy' => array('policy_color'),
        'publisher_request_method' => array('request_method'),
        'publisher_embargo_period' => array('date'),
        'author_policy' => array('author_policy'),
        'author_request_method' => array('request_method'),
        'author_status_id' => array('notempty', 'status'),
        'publisher_status_id' => array('notempty', 'status'),
        'coauthor_status_id' => array('notempty', 'status'),
        'file1' => array('file'),
        'file2' => array('file'),
        'file3' => array('file'),
        'file4' => array('file'),
        'file5' => array('file'),
    );

    public $validationSets = array(
        'author_policy' => array(
            'id' => array('required', 'notempty'),
            'author_policy' => array('required', 'notempty', 'author_policy'),
        ),
        'author_comment' => array(
            'id' => array('required', 'notempty'),
            'author_comment' => array('required', 'notempty'),
        ),
        'upload' => array(
            'id' => array('required', 'notempty'),
            'file1' => array('file'),
            'file2' => array('file'),
            'file3' => array('file'),
            'file4' => array('file'),
            'file5' => array('file'),
        ),
        'register_upload' => array(
            'id' => array('required', 'notempty'),
            'file1' => array('withoutfile', 'file'),
            'file2' => array('file'),
            'file3' => array('file'),
            'file4' => array('file'),
            'file5' => array('file'),
        ),
    );

    public $filterArgs = array(
        array('name' => 'keyword', 'type' => 'query', 'method' => 'buildSearchByKeywordCondition'),
        array('name' => 'author_status_id', 'type' => 'value'),
        array('name' => 'publisher_status_id', 'type' => 'value'),
        array('name' => 'coauthor_status_id', 'type' => 'value'),
        array('name' => 'author_policy', 'type' => 'query', 'method' => 'buildAuthorPolicyCondition'),
        array('name' => 'file_status', 'type' => 'query', 'method' => 'buildFileStatusCondition'),
        array('name' => 'publisher_embargo_period_complete', 'type' => 'query', 'method' => 'buildPublisherEmbargoPeriodCondition'),
    );

    /**
     * beforeValidate
     *
     */
    public function beforeValidate(){
        // hash
        if (empty($this->data['Article'][$this->primaryKey]) && empty($this->data['Article']['hash'])) {
            $this->data['Article']['hash'] = $this->generateHash();
        }

        // identifier_issn
        // ハイフンを削除
        if (!empty($this->data['Article']['identifier_issn'])) {
            $this->data['Article']['identifier_issn'] = str_replace('-', '', $this->data['Article']['identifier_issn']);
        }

        // file_count
        $count = 0;
        if (empty($this->data['Article'][$this->primaryKey])) {
            for ($i = 0; $i < 5; $i++) {
                if (!empty($this->data['Article']['file' . $i])) {
                    $count++;
                }
            }
        } else {
            $article = $this->view($this->data['Article'][$this->primaryKey]);
            for ($i = 0; $i < 5; $i++) {
                if (!empty($article['Article']['file' . $i]) || !empty($this->data['Article']['file' . $i])) {
                    $count++;
                }
            }
            for ($i = 0; $i < 5; $i++) {
                if (!empty($this->data['Article']['delete_file' . $i])) {
                    $count--;
                }
            }
        }
        $this->data['Article']['file_count'] = $count;
        $this->hasAll();

        // author_status_id
        if (empty($this->data['Article'][$this->primaryKey]) && empty($this->data['Article']['author_status_id'])) {
            $status = $this->AuthorStatus->findDefaultStatus(STATUS_TYPE_OPEN);
            $this->data['Article']['author_status_id'] = $status['AuthorStatus']['id'];
        }

        // publisher_status_id
        if (empty($this->data['Article'][$this->primaryKey]) && empty($this->data['Article']['publisher_status_id'])) {
            $status = $this->PublisherStatus->findDefaultStatus(STATUS_TYPE_OPEN);
            $this->data['Article']['publisher_status_id'] = $status['PublisherStatus']['id'];
        }

        // coauthor_status_id
        if (empty($this->data['Article'][$this->primaryKey]) && empty($this->data['Article']['coauthor_status_id'])) {
            $status = $this->CoauthorStatus->findDefaultStatus(STATUS_TYPE_OPEN);
            $this->data['Article']['coauthor_status_id'] = $status['CoauthorStatus']['id'];
        }

        // Filter Plugins
        $filterPlugins = json_decode(Setting::getSetting('filter_plugins'), true);
        foreach ($filterPlugins as $key => $plugin) {
            if (!empty($this->data['Article']['publisher_source'])) {
                continue;
            }
            $this->{$plugin} = ClassRegistry::init($plugin . '.' . $plugin);
            $filterd = $this->{$plugin}->filter($this->data);
            if ($filterd !== $this->data) {
                $this->data = $filterd;
            }
        }
        parent::beforeValidate();
        return true;
    }

    /**
     * beforeSave
     *
     * @param $data, $primary
     */
    public function beforeSave($options){
        parent::beforeSave($options);
        return true;
    }

    /**
     * afterSave
     *
     */
    public function afterSave($created){
        parent::afterSave($created);

        if ($created) {
            $id = $this->getLastInsertId();
        } else {
            $id = $this->data['Article']['id'];
        }

        $this->ArticleHistory = ClassRegistry::init('ArticleHistory');
        $this->ArticleHistory->pushHistory($id);
    }

    /**
     * setAuthorPolicy
     *
     * @param $id, $policy
     */
    public function setAuthorPolicy($id, $policy){
        $this->setValidation('author_policy');
        $data = array('Article' => array(
                'id' => $id,
                'author_policy' => $policy
            ));
        return $this->edit($id, $data);
    }

    /**
     * generateHash
     *
     */
    public function generateHash(){
        return Security::hash(uniqid('', true));
    }

    /**
     * setOpenStatuses
     *
     */
    public function setOpenStatuses(){
        $this->authorOpenStatus = $this->AuthorStatus->findStatuses('list', STATUS_TYPE_OPEN);
        $this->publisherOpenStatus = $this->PublisherStatus->findStatuses('list', STATUS_TYPE_OPEN);
        $this->coauthorOpenStatus = $this->CoauthorStatus->findStatuses('list', STATUS_TYPE_OPEN);
    }

    /**
     * findArticlesOpenCount
     * OPEN系のステータスの案件数
     *
     */
    public function findArticlesOpenCount(){
        $this->hasAll();
        $query = array();
        $query['conditions'] = array('OR' => array(
                'Article.author_status_id' => array_keys($this->authorOpenStatus),
                'Article.publisher_status_id' => array_keys($this->publisherOpenStatus),
                'Article.coauthor_status_id' => array_keys($this->coauthorOpenStatus),
            ));
        return $this->find('count', $query);
    }

    /**
     * findArticlesAuthorPolicyCount
     * OPEN系で著者許諾可否が登録されている案件数
     *
     */
    public function findArticlesAuthorPolicyCount(){
        $query = array();
        $query['conditions'] = array(
            'Article.author_policy' => array_keys(Configure::read('Article.author_policies')),
            'OR' => array(
                'Article.author_status_id' => array_keys($this->authorOpenStatus),
                'Article.publisher_status_id' => array_keys($this->publisherOpenStatus),
                'Article.coauthor_status_id' => array_keys($this->coauthorOpenStatus),
            )
        );
        return $this->find('count', $query);
    }

    /**
     * findArticlesFileUploadedCount
     * OPEN系で本文アップロード済みの案件数
     *
     */
    public function findArticlesFileUploadedCount(){
        $query = array();
        $query['conditions'] = array(
            'Article.file_count  >' => 0,
            'OR' => array(
                'Article.author_status_id' => array_keys($this->authorOpenStatus),
                'Article.publisher_status_id' => array_keys($this->publisherOpenStatus),
                'Article.coauthor_status_id' => array_keys($this->coauthorOpenStatus),
            )
        );
        return $this->find('count', $query);
    }

    /**
     * findArticlesEmbargoCompleteCount
     * OPEN系でエンバーゴ期間満了の案件数
     *
     */
    public function findArticlesEmbargoCompleteCount(){
        $query = array();
        $query['conditions'] = array(
            'Article.publisher_embargo_period <' => date('Y-m-d'),
            'OR' => array(
                'Article.author_status_id' => array_keys($this->authorOpenStatus),
                'Article.publisher_status_id' => array_keys($this->publisherOpenStatus),
                'Article.coauthor_status_id' => array_keys($this->coauthorOpenStatus),
            )
        );
        return $this->find('count', $query);
    }

    /**
     * buildSearchByKeywordCondition
     * メタデータ項目を対象にした検索条件を作成
     *
     * @param $data
     */
    public function buildSearchByKeywordCondition($data){
        $keyword = $data['keyword'];
        $schema = $this->schema(true);
        $ignoreFields = array(
            'id',
            'hash',
            'file_count',
            'date_issued',
            'peerreviewed',
            'source',
            'publisher_policy',
            'publisher_policy_type',
            'publisher_embargo_period',
            'publisher_request_method',
            'auhtor_policy',
            'author_coauthor_flg',
            'author_request_method',
            'author_contact_info',
            'author_coauthor_flg',
            'publisher_status_id',
            'author_status_id',
            'coauthor_status_id',
            'created',
            'modified',
            'delete_flg',
            'deleted',
        );
        foreach ($ignoreFields as $field) {
            unset($schema[$field]);
        }

        $conditions = array('OR' => array());
        foreach ($schema as $field => $value) {
            $conditions['OR'][] = array("{$this->alias}.{$field} LIKE" => "%{$keyword}%");
        }
        return $conditions;
    }

    /**
     * buildAuthorPolicyCondition
     * 著者許諾状況
     *
     * @param $data
     */
    public function buildAuthorPolicyCondition($data){
        $policy = $data['author_policy'];
        if ($policy === ARTICLE_AUTHOR_POLICY_NOT_NULL) {
            return array('Article.author_policy' => array_keys(Configure::read('Article.author_policies')));
        } else {
            return array('Article.author_policy' => $policy);
        }
    }

    /**
     * buildFileStatusCondition
     * 本文ファイルアップロード状況
     *
     */
    public function buildFileStatusCondition($data){
        $status = $data['file_status'];
        if ($status) {
            return array('Article.file_count >' => 0);
        } else {
            return array('Article.file_count' => 0);
        }
    }

    /**
     * buildPublisherEmbargoPeriodCondition
     * エンバーゴ期間満了かどうか
     *
     */
    public function buildPublisherEmbargoPeriodCondition($data){
        $status = $data['publisher_embargo_period_complete'];
        if ($status) {
            return array('Article.publisher_embargo_period <' => date('Y-m-d'));
        } else {
            return array();
        }
    }
}