<?php
App::uses('AuthorStatus', 'Model');

/**
 * CoauthorStatus Model
 *
 */
class CoauthorStatus extends AuthorStatus {

    public $displayField = 'name';

    public $validate = array(
        'name' => array('required', 'notempty', 'unique'),
    );
}