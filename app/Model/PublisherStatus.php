<?php
App::uses('AuthorStatus', 'Model');

/**
 * PublisherStatus Model
 *
 */
class PublisherStatus extends AuthorStatus {

    public $displayField = 'name';

    public $validate = array(
        'name' => array('required', 'notempty', 'unique'),
    );
}