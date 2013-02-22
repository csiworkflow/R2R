<?php

App::uses('RoutineModel', 'Routine.Model');

/**
 * DocumentTemplate Model
 *
 */
class DocumentTemplate extends RoutineModel {

    public $displayField = 'name';

    public $validate = array(
        'name' => array('required', 'notempty', 'unique'),
    );

}