<?php
App::uses('AppController', 'Controller');
App::uses('RoutineController', 'Routine.Controller');

class ArticleHistoriesController extends RoutineController {

    public $uses = array(
        'ArticleHistory',
        'Article',
        'AuthorStatus',
        'PublisherStatus',
        'CoauthorStatus',
    );
    public $components = array(
        'Search.Prg',
    );

    public $presetVars = array(
        array('field' => 'article_id', 'type' => 'value'),
    );

    /**
     * beforeFilter
     *
     */
    public function beforeFilter(){
        parent::beforeFilter();
        $this->ArticleHistory->hasAll();
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
                'author_statuses' => $this->AuthorStatus->find('list'),
                'publisher_statuses' => $this->PublisherStatus->find('list'),
                'coauthor_statuses' => $this->CoauthorStatus->find('list'),
            ));
    }

    /**
     * index
     *
     */
    public function index(){
        $this->_search();
    }

    /**
     * add
     *
     */
    public function add(){
        throw new InternalErrorException();
    }

    /**
     * edit
     *
     */
    public function edit($id){
        throw new InternalErrorException();
    }

    /**
     * delete
     *
     */
    public function delete($id){
        throw new InternalErrorException();
    }

}