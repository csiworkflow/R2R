<?php
/**
 * AdditionalValidationPatternsBehavior
 *
 * jpn: Cakeplus用のカスタムバリデーションパターン
 */
class AdditionalValidationPatternsBehavior extends ModelBehavior {

    public $validationPatterns = array(
        'required' => array(
            'required' => array(
                'rule' => '/.*/',
                'required' => true,
                'last' => true,
            ),
        ),
        'notempty' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'required' => false,
                'last' => true
            ),
        ),
        'checkbox_check' => array(
            'checkboxCheck' => array(
                'rule' => '/^[^0]$/',
                'required' => false,
                'last' => true
            ),
        ),
        'date' => array(
            'date' => array(
                'rule' => array('date'),
                'allowEmpty' => true,
                'required' => false,
                'last' => true
            ),
        ),
        // jpn: 数値チェック用
        'numeric' => array(
            'numeric' => array(
                'rule' => '/^[0-9]+$/',
                'last' => true,
            ),
        ),
        'unique' => array(
            'isUnique' => array(
                'rule' => array('isUnique'),
                'allowEmpty' => true,
                'required' => false,
                'last' => true,
            )
        ),
        'password_confirm' => array(
            'compare2fieldsPassword' => array(
                'rule' => array('compare2fields', 'password'),
                'last' => true,
            )
        ),
        // jpn:
        'zenkaku_only' => array(
            'zenkakuOnly' => array(
                'rule' => array('zenkakuOnly'),
                'allowEmpty' => true,
                'last' => true,
            ),
        ),
        'katakana_only' => array(
            'katakanaOnly' => array(
                'rule' => array('zenkakuOnly'),
                'allowEmpty' => true,
                'last' => true,
            ),
        ),
        'katakana_and_space' => array(
            'katakanaAndSpace' => array(
                'rule' => array('katakanaAndSpace'),
                'allowEmpty' => true,
                'last' => true,
            ),
        ),
    );

    /**
     * setUp
     *
     */
    public function setUp(Model $model){
        $this->mergeValidationPatterns($model);
    }

    /**
     * getValidationMessages
     *
     */
    public function getValidationMessages(){
        return array(
            'required'               => __d('yav', 'Validation Error: required'),
            'notEmpty'               => __d('yav', 'Validation Error: notEmpty'),
            'checkboxCheck'          => __d('yav', 'Validation Error: checkboxCheck'),
            'numeric'                => __d('yav', 'Validation Error: numeric'),
            'isUnique'               => __d('yav', 'Validation Error: isUnique'),
            'date'                   => __d('yav', 'Validation Error: date'),
            'compare2fieldsPassword' => __d('yav', 'Validation Error: compare2fieldsPassword'),
            'zenkakuOnly'            => __d('yav', 'Validation Error: zenkakuOnly'),
            'katakanaOnly'           => __d('yav', 'Validation Error: katakanaOnly'),
            'katakanaAndSpace'       => __d('yav', 'Validation Error: katakanaAndSpace'),
            'notEmptyFile'           => __d('yav', 'Validation Error: notEmptyFile'),
            'checkExtension'         => __d('yav', 'Validation Error: checkExtension'),
            'checkFileSize'          => __d('yav', 'Validation Error: checkFileSize'),
            'checkboxCheck'          => __d('yav', 'Validation Error: checkboxCheck'),
        );
    }

    /**
     * mergeValidationPatterns
     *
     */
    private function mergeValidationPatterns(Model $model){
        $model->validation_patterns = Hash::merge($this->validationPatterns, $model->validation_patterns);
    }

}