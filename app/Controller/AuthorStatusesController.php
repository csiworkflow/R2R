<?php
App::uses('AppController', 'Controller');
App::uses('RoutineController', 'Routine.Controller');

class AuthorStatusesController extends RoutineController {

    public $uses = array(
        'AuthorStatus',
        'CoauthorStatus',
        'PublisherStatus',
    );

    /**
     * index
     *
     */
    public function index(){
        $this->AuthorStatus->init();
        $authorStatuses = $this->AuthorStatus->find('all');
        $authorDefaultOpenStatus= $this->AuthorStatus->findDefaultStatus(STATUS_TYPE_OPEN);
        $authorDefaultCloseStatus = $this->AuthorStatus->findDefaultStatus(STATUS_TYPE_CLOSE);
        $this->CoauthorStatus->init();
        $coauthorStatuses = $this->CoauthorStatus->find('all');
        $coauthorDefaultOpenStatus = $this->CoauthorStatus->findDefaultStatus(STATUS_TYPE_OPEN);
        $coauthorDefaultCloseStatus = $this->CoauthorStatus->findDefaultStatus(STATUS_TYPE_CLOSE);
        $this->PublisherStatus->init();
        $publisherStatuses = $this->PublisherStatus->find('all');
        $publisherDefaultOpenStatus = $this->PublisherStatus->findDefaultStatus(STATUS_TYPE_OPEN);
        $publisherDefaultCloseStatus = $this->PublisherStatus->findDefaultStatus(STATUS_TYPE_CLOSE);
        $this->set(compact(
                'authorStatuses',
                'coauthorStatuses',
                'publisherStatuses',
                'authorDefaultOpenStatus',
                'authorDefaultCloseStatus',
                'coauthorDefaultOpenStatus',
                'coauthorDefaultCloseStatus',
                'publisherDefaultOpenStatus',
                'publisherDefaultCloseStatus'
            ));
    }

}