<?php

class BulkStatusChangesController extends BulkStatusChangeAppController {

    public $uses = array(
        'Article',
        'AuthorStatus',
        'PublisherStatus',
        'CoauthorStatus',
    );

    /**
     * change
     * ステータス一括変換処理
     *
     */
    public function change(){
        $data = $this->request->data;
        $conditions = $this->Article->parseCriteria($data['Article']);
        if (empty($conditions)) {
            $this->Session->setFlash(
                __('Set Search Conditions'),
                $this->setFlashElement['error'],
                $this->setFlashParams['error']);
            $this->redirect(array('controller' => 'articles', 'action' => 'index', 'plugin' => false));
        }
        if (
            empty($conditions['Article.author_status_id'])
            && empty($conditions['Article.publisher_status_id'])
            && empty($conditions['Article.coauthor_status_id'])
        ) {
            // デフォルトの条件設定
            $authorOpenStatus = $this->AuthorStatus->findStatuses('list', STATUS_TYPE_OPEN);
            $publisherOpenStatus = $this->PublisherStatus->findStatuses('list', STATUS_TYPE_OPEN);
            $coauthorOpenStatus = $this->CoauthorStatus->findStatuses('list', STATUS_TYPE_OPEN);
            $conditions[] = array('OR' => array(
                    'Article.author_status_id' => array_keys($authorOpenStatus),
                    'Article.publisher_status_id' => array_keys($publisherOpenStatus),
                    'Article.coauthor_status_id' => array_keys($coauthorOpenStatus),
                ));
        }
        $author_status_id = $data['Article']['change_author_status_id'];
        $publisher_status_id = $data['Article']['change_publisher_status_id'];
        $coauthor_status_id = $data['Article']['change_coauthor_status_id'];

        $fields = array();
        if (!empty($data['Article']['change_author_status_id'])) {
            $fields['Article.author_status_id'] = $data['Article']['change_author_status_id'];
        }

        if (!empty($data['Article']['change_publisher_status_id'])) {
            $fields['Article.publisher_status_id'] = $data['Article']['change_publisher_status_id'];
        }

        if (!empty($data['Article']['change_coauthor_status_id'])) {
            $fields['Article.coauthor_status_id'] = $data['Article']['change_coauthor_status_id'];
        }

        $result = $this->Article->updateAll($fields, $conditions);
        if ($result !== true) {
            throw new InternalErrorException();
        }
        $this->Session->setFlash(
            __('The %s has been modified', __(Inflector::humanize($this->modelClass))),
            $this->setFlashElement['success'],
            $this->setFlashParams['success']);
        $this->redirect(array('controller' => 'articles', 'action' => 'index', 'plugin' => false));
    }
}
