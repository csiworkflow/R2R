<?php

class YavPost extends CakeTestModel {

    public $name = 'YavPost';
    public $actsAs = array(
                           'Cakeplus.AddValidationRule',
                           'Yav.AdditionalValidationRules'
                           );

    public $validate = array(
                             'not_empty_with1' => array('notEmptyWith' => array('rule' => array('notEmptyWith', array('not_empty_with2', 'not_empty_with3')))),
                             'katakana_and_space' => array('katakanaAndSpace' => array('rule' => array('katakanaAndSpace'))),
                             );
}

class AdditionalValidationRulesTest extends CakeTestCase {

    public $fixtures = array('plugin.yav.yav_post');

    /**
     * setUp
     *
     */
    public function setUp(){
        $this->YavPost = ClassRegistry::init('YavPost');
    }

    /**
     * tearDown
     *
     */
    public function tearDown(){
        unset($this->YavPost);
    }

    /**
     * test_notEmptyWith
     *
     */
    public function test_notEmptyWith(){
        $data = array(
                'YavPost' => array(
                                   'title' => 'タイトル',
                                   'not_empty_with1' => '',
                    ),
                );
        $this->assertIdentical( $this->YavPost->create( $data ) , $data);
        $this->YavPost->validates();
        $this->assertFalse( array_key_exists('not_empty_with1' , $this->YavPost->validationErrors ) );

        $data = array(
                'YavPost' => array(
                                   'title' => 'タイトル',
                                   'not_empty_with1' => '',
                                   'not_empty_with3' => '空でない',
                    ),
                );
        $this->assertIdentical( $this->YavPost->create( $data ) , $data);
        $this->YavPost->validates();
        $this->assertTrue( array_key_exists('not_empty_with1' , $this->YavPost->validationErrors ) );
    }

    /**
     * test_katakanaAndSpace
     *
     */
    public function test_katakanaAndSpace(){
        $data = array(
                'YavPost' => array(
                    'katakana_and_space'  =>  'hiragana',
                    ),
                );
        $this->assertIdentical( $this->YavPost->create( $data ) , $data);
        $this->YavPost->validates();
        $this->assertTrue( array_key_exists('katakana_and_space' , $this->YavPost->validationErrors ) );

        $data = array(
                'YavPost' => array(
                    'katakana_and_space'  =>  'カタカナ　ト　スペース',
                    ),
                );
        $this->assertIdentical( $this->YavPost->create( $data ) , $data);
        $this->YavPost->validates();
        $this->assertFalse( array_key_exists('katakana_and_space' , $this->YavPost->validationErrors ) );
    }
}