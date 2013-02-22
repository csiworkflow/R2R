<?php
App::uses('RoutineModel', 'Routine.Model');

/**
 * AuthorStatus Model
 *
 */
class AuthorStatus extends RoutineModel {

    public $displayField = 'name';

    public $validate = array(
        'name' => array('required', 'notempty', 'unique'),
        'type' => array('required', 'notempty'),
    );

    /**
     * init
     *
     */
    public function init(){
        $query = array();
        $query['conditions'] = array('type' => STATUS_TYPE_OPEN);
        $count = $this->find('count', $query);
        if ($count === 0) {
            $data = array(
                'type' => STATUS_TYPE_OPEN,
                'name' => Setting::getSetting('status_open_default')
            );
            $this->create();
            $this->save($data);
        }
        $query = array();
        $query['conditions'] = array('type' => STATUS_TYPE_CLOSE);
        $count = $this->find('count', $query);
        if ($count === 0) {
            $data = array(
                'type' => STATUS_TYPE_CLOSE,
                'name' => Setting::getSetting('status_close_default')
            );
            $this->create();
            $this->save($data);
        }
    }

    /**
     * findDefaultStatus
     * 最小idのステータス
     *
     */
    public function findDefaultStatus($statusType = STATUS_TYPE_OPEN){
        $query = array();
        $query['conditions'] = array('type' => $statusType);
        $query['order'] = array("{$this->primaryKey} ASC");
        $result = $this->find('first', $query);
        if (empty($result)) {
            throw new NotFoundException(__('Invalid Access'));
        }
        return $result;
    }

    /**
     * findStatuses
     *
     */
    public function findStatuses($type = 'list', $statusType = STATUS_TYPE_OPEN){
        $query = array();
        $query['conditions'] = array('type' => $statusType);
        $query['order'] = array("{$this->primaryKey} ASC");
        $result = $this->find($type, $query);
        if (empty($result)) {
            throw new NotFoundException(__('Invalid Access'));
        }
        return $result;
    }

    /**
     * delete
     *
     * @param $id
     */
    public function delete($id){
        $current = $this->find('first', array(
                'conditions' => array(
                    "{$this->alias}.{$this->primaryKey}" => $id,
                )));

        if (empty($current)) {
            throw new NotFoundException(__('Invalid Access'));
        }
        // 最低でもtypeごとに1つ以上ステータスが存在する必要がる
        $query = array();
        $query['conditions'] = array('type' => $current[$this->alias]['type']);
        $count = $this->find('count', $query);
        if ($count < 2) {
            throw new ValidationException(__('Status Min Error'));
        }
        // 最小idのステータスは削除できない
        $nodelete = $this->findDefaultStatus($current[$this->alias]['type']);
        if ($id == $nodelete[$this->alias][$this->primaryKey]) {
            throw new ValidationException(__('Default Status can not delete'));
        }
        parent::delete($id);
    }
}