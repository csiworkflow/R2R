<?php
App::uses('AppController', 'Controller');
App::uses('RoutineController', 'Routine.Controller');

class PublisherStatusesController extends RoutineController {

    /**
     * _addRedirect
     *
     */
    protected function _addRedirect(){
        $this->redirect(array('controller' => 'author_statuses', 'action' => 'index'));
    }
}