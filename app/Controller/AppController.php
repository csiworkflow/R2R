<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');
App::import('Partial.Lib/View', 'PartialView');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $viewClass = 'Partial';

    public $components = array(
        'Session',
        'Transition',
        'Security',
        'Paginator',
        'Secured.Ssl' => array(
            'secured' => array(
                '*'
            ),
            'autoRedirect' => true),
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'articles',
                'action' => 'index'),
            'logoutRedirect' => '/',
            'authenticate' => array('Form' => array(
                    'userModel' => 'User',
                    'fields' => array('username' => 'username'),
                ),
            )),
        'Escape.Escape' => array('formDataEscape' => false),
        'Search.Prg',
        'DebugKit.Toolbar',
    );

    public $helpers = array(
        'Session',
        'Html' => array('className' => 'TwitterBootstrap.BootstrapHtml'),
        'Form' => array('className' => 'TwitterBootstrap.BootstrapForm'),
        'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator'),
        'Yamd.Markdown',
    );

    protected $defaultFlashElement = array(
        'success' => 'alert',
        'error' => 'alert',
    );
    protected $defaultFlashParams = array(
        'success' => array(
            'plugin' => 'TwitterBootstrap',
            'class' => 'alert-success'
        ),
        'error' => array(
            'plugin' => 'TwitterBootstrap',
            'class' => 'alert-error'
        ),
    );

    /**
     * beforeFilter
     *
     */
    public function beforeFilter(){
        parent::beforeFilter();
        $this->setFlashElement = $this->defaultFlashElement;
        $this->setFlashParams = $this->defaultFlashParams;

        Configure::write('Config.language', 'ja');

        // Import Plugins
        $importPlugins = json_decode(Setting::getSetting('import_plugins'), true);
        // Bulk Plugins
        $bulkPlugins = json_decode(Setting::getSetting('bulk_plugins'), true);
        // Filter Plugins
        $filterPlugins = json_decode(Setting::getSetting('filter_plugins'), true);

        $colors = Configure::read('Article.policy_colors');
        $author_policies = Configure::read('Article.author_policies');
        $coauthor_policies = $author_policies;
        unset($coauthor_policies[ARTICLE_AUTHOR_POLICY_OK_AND_UPLOAD]); // 共著者では2つのステータスでよい
        $this->set(array(
                'baseUrl' => Router::url('/'),
                'import_plugins' => $importPlugins,
                'bulk_plugins' => $bulkPlugins,
                'filter_plugins' => $filterPlugins,
                'policy_colors' => $colors,
                'publisher_policies' => $colors,
                'author_policies' => $author_policies,
                'coauthor_policies' => $coauthor_policies,
                'policy_color_descriptions' => Configure::read('Article.policy_color_descriptions'),
                'publisher_open_file_versions' => Configure::read('Article.publisher_open_file_versions'),
                'status_types' => Configure::read('status_types'),
            ));
    }

    /**
     * beforeRender
     *
     */
    public function beforeRender(){
        parent::beforeRender();
    }
}
