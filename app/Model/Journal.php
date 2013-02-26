<?php
App::uses('RoutineModel', 'Routine.Model');

/**
 * Journal Model
 *
 */
class Journal extends RoutineModel {

    public $displayField = 'title';
    public $actsAs = array(
        'Search.Searchable',
        'Yacsv.Importer',
    );

    public $validate = array(
        'title' => array('required', 'notempty', 'unique'),
        'issn' => array('issn'),
        'publisher_policy' => array('policy_color'),
        'publisher_open_file_version' => array('publisher_open_file_version'),
        'publisher_request_method' => array('request_method'),
    );

    public $filterArgs = array(
        array('name' => 'keyword', 'type' => 'query', 'method' => 'buildSearchByKeywordCondition'),
        array('name' => 'publisher_policy', 'type' => 'value'),
    );

    /**
     * beforeValidate
     *
     */
    public function beforeValidate(){
        // issn
        // ハイフンを削除
        if (!empty($this->data['Journal']['issn'])) {
            $this->data['Journal']['issn'] = str_replace('-', '', $this->data['Journal']['issn']);
        }
        parent::beforeValidate();
    }

    /**
     * buildSearchByKeywordCondition
     * 検索条件を作成
     *
     * @param $data
     */
    public function buildSearchByKeywordCondition($data){
        $keyword = $data['keyword'];
        $fields = array(
            'title',
            'publisher',
            'issn',
        );
        $conditions = array('OR' => array());
        foreach ($fields as $field) {
            $conditions['OR'][] = array("{$this->alias}.{$field} LIKE" => "%{$keyword}%");
        }
        return $conditions;
    }
}