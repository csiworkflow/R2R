<?php
App::uses('AppController', 'Controller');
App::uses('RoutineController', 'Routine.Controller');

class DocumentTemplatesController extends RoutineController {

    public $uses = array(
        'DocumentTemplate',
        'Article',
    );

    /**
     * clip
     *
     * @param $id, $article_id
     */
    public function clip($id = null, $article_id = null){
        $documentTemplate = $this->DocumentTemplate->view($id);
        $article = $this->Article->view($article_id);

        if (empty($documentTemplate) || empty($article)) {
            throw new InternalErrorException();
        }

        $this->set(compact(
                'documentTemplate',
                'article'
            ));
    }

}