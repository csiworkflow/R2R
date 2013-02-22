<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

    public $actsAs = array(
        'HasNo.HasNo',
        'Cakeplus.ValidationPatterns',
        'Cakeplus.ValidationErrorI18n',
        'Cakeplus.AddValidationRule',
        'Yav.AdditionalValidationRules',
        'Yav.AdditionalValidationPatterns',
        'Multivalidatable',
        'Yasd.SoftDeletable',
        'CustomValidation',
    );

    public $validation_patterns = array(
        'file' => array(
            'checkFileSize' => array(
                'rule' => array('checkFileSize', MAX_FILE_SIZE),
                'allowEmpty' => true,
                'last' => true),
        ),
        'withoutfile' => array(
            'notEmptyFile' => array(
                'rule' => array('notEmptyWithout', array('file2', 'file3', 'file4', 'file5')),
                'required' => true,
                'allowEmpty' => false,
                'last' => true),
        ),
        'policy_color' => array(
            'invalidStatus' => array(
                'rule' => array(
                    'inList', array(
                        ARTICLE_POLICY_COLOR_GREEN,
                        ARTICLE_POLICY_COLOR_BLUE,
                        ARTICLE_POLICY_COLOR_YELLOW,
                        ARTICLE_POLICY_COLOR_WHITE,
                        ARTICLE_POLICY_COLOR_GRAY,
                    )),
                'allowEmpty' => true,
                'last' => true,
            ),
        ),
        'status' => array(
            'invalidStatus' => array(
                'rule' => array('recordExists'),
                'allowEmpty' => true,
                'last' => true,
            ),
        ),
        'author_policy' => array(
            'isList' => array(
                'rule' => array(
                    'inListFromConfigure', 'Article.author_policies'
                ),
                'allowEmpty' => true,
                'last' => true,
            ),
        ),
        'issn' => array(
            'issn' => array(
                'rule' => '/^[0-9X]{8}$/',
                'allowEmpty' => true,
                'last' => true,
            ),
        ),
        'unique_issn' => array(
            'isUniqueIssn' => array(
                'rule' => array('isUniqueIssn'),
                'last' => true,
            ),
        ),
        'language_iso' => array(
            'isList' => array(
                'rule' => array(
                    'inListFromConfigure', 'Article.language_isos'
                ),
                'allowEmpty' => true,
                'last' => true,
            ),
        ),
        'language_iso639_2' => array(
            'isList' => array(
                'rule' => array(
                    'inListFromConfigure', 'Article.language_iso639_2s'
                ),
                'allowEmpty' => true,
                'last' => true,
            ),
        ),
        'publicationstatus' => array(
            'isList' => array(
                'rule' => array(
                    'inListFromConfigure', 'Article.publicationstatuses'
                ),
                'allowEmpty' => true,
                'last' => true,
            ),
        ),
        'peerreviewed' => array(
            'isList' => array(
                'rule' => array(
                    'inListFromConfigure', 'Article.peerrevieweds'
                ),
                'allowEmpty' => true,
                'last' => true,
            ),
        ),
        'type_nii' => array(
            'isList' => array(
                'rule' => array(
                    'inListFromConfigure', 'Article.type_niis'
                ),
                'allowEmpty' => true,
                'last' => true,
            ),
        ),
        'textversion' => array(
            'isList' => array(
                'rule' => array(
                    'inListFromConfigure', 'Article.textversions'
                ),
                'allowEmpty' => true,
                'last' => true,
            ),
        ),
        'publisher_open_file_version' => array(
            'isList' => array(
                'rule' => array(
                    'inListFromConfigure', 'Article.publisher_open_file_versions'
                ),
                'allowEmpty' => true,
                'last' => true,
            ),
        ),
        'request_method' => array(
            'isList' => array(
                'rule' => array(
                    'inListFromConfigure', 'Article.request_methods'
                ),
                'allowEmpty' => true,
                'last' => true,
            ),
        ),
        'btn_display_type' => array(
            'isList' => array(
                'rule' => array(
                    'inListFromConfigure', 'PageContent.btn_display_types'
                ),
                'allowEmpty' => true,
                'last' => true,
            ),
        ),
    );

    /**
     * beforeValidate
     *
     */
    public function beforeValidate(){
        $errorMessages = Hash::merge(
            $this->getValidationMessages(),
            array(
                'invalidStatus' => __('Validation Error: invalidStatus'),
                'isList' => __('Validation Error: isList'),
                'issn' => __('Validation Error: issn'),
                'isUniqueIssn' => __('Validation Error: isUniqueIssn'),
            ));
        parent::beforeValidate();
        $this->setValidationPatterns();
        $this->setErrorMessageI18n($errorMessages, false);
        $this->replaceValidationErrorMessagesI18n();
    }
}
