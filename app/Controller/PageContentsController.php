<?php
App::uses('AppController', 'Controller');

class PageContentsController extends AppController {

    /**
     * index
     *
     */
    public function index(){
        $contents = $this->PageContent->findContents();
        $this->set(compact('contents'));
    }

    /**
     * update
     *
     * @param $id, $view
     */
    public function update($id = null, $view = null){
        if (!$id || !$view) {
            throw new InternalErrorException();
        }
        try {
            $result = $this->PageContent->edit($id, $this->request->data);
            if ($result === true) {
                $this->Session->setFlash(
                    __('The %s has been modified', __('PageContent')),
                    $this->setFlashElement['success'],
                    $this->setFlashParams['success']);
                $this->redirect(array('action' => 'index'));
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
        $this->set(compact('id', 'view'));
        $this->render($view);
    }

    /**
     * beforeRender
     *
     */
    public function beforeRender(){
        parent::beforeRender();
        $this->set(array(
                'btn_display_types' => Configure::read('PageContent.btn_display_types'),
            ));
    }
}
