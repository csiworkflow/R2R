<?php
App::uses('RoutineModel', 'Routine.Model');

/**
 * PageContent Model
 *
 */
class PageContent extends RoutineModel {

    public $validate = array (
        'btn_label_ok_and_upload' => array ('notempty'),
        'btn_label_ok' => array ('notempty'),
        'btn_label_ng' => array ('notempty'),
        'btn_display_type' => array ('notempty', 'btn_display_type'),
    );

    /**
     * init
     *
     */
    public function init(){
        $data = array(
            'PageContent' => array(
                'btn_label_ok_and_upload' => Setting::getSetting('btn_label_ok_and_upload_default'),
                'btn_label_ok' => Setting::getSetting('btn_label_ok_default'),
                'btn_label_ng' => Setting::getSetting('btn_label_ng_default'),
            ),
        );

        return $this->save($data);
    }

    /**
     * findContents
     *
     */
    public function findContents(){
        $query = array();
        $query['order'] = array('id DESC');
        $contents = $this->find('first', $query);
        if (empty($contents)) {
            $this->init();
            return $this->findContents();
        }
        return $contents;
    }

}