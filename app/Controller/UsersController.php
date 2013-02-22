<?php
App::uses('AppController', 'Controller');
App::uses('RoutineController', 'Routine.Controller');

class UsersController extends RoutineController {

    /**
     * beforeFilter
     *
     */
    function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow(array('init'));
    }

    /**
     * login
     *
     */
    public function login(){
        if ($this->User->find('count') === 0) {
            $this->redirect(array('action' => 'init'));
        }
        $this->_login();
    }

    /**
     * logout
     *
     */
    public function logout(){
        $this->_logout();
    }

    /**
     * init
     * ユーザ初期登録
     *
     */
    public function init(){
        $this->add();
        if ($this->User->find('count') > 0) {
            $this->redirect('/');
        }
        // 初期処理
        $this->AuthorStatus = ClassRegistry::init('AuthorStatus');
        $this->PublisherStatus = ClassRegistry::init('PublisherStatus');
        $this->CoauthorStatus = ClassRegistry::init('CoauthorStatus');
        $this->AuthorStatus->init();
        $this->PublisherStatus->init();
        $this->CoauthorStatus->init();
    }
}
