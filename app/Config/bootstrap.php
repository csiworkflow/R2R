<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Cache Engine Configuration
 * Default settings provided below
 *
 * File storage engine.
 *
 *   Cache::config('default', array(
 *      'engine' => 'File', //[required]
 *      'duration'=> 3600, //[optional]
 *      'probability'=> 100, //[optional]
 *      'path' => CACHE, //[optional] use system tmp directory - remember to use absolute path
 *      'prefix' => 'cake_', //[optional]  prefix every cache file with this string
 *      'lock' => false, //[optional]  use file locking
 *      'serialize' => true, // [optional]
 *      'mask' => 0666, // [optional] permission mask to use when creating cache files
 *  ));
 *
 * APC (http://pecl.php.net/package/APC)
 *
 *   Cache::config('default', array(
 *      'engine' => 'Apc', //[required]
 *      'duration'=> 3600, //[optional]
 *      'probability'=> 100, //[optional]
 *      'prefix' => Inflector::slug(APP_DIR) . '_', //[optional]  prefix every cache file with this string
 *  ));
 *
 * Xcache (http://xcache.lighttpd.net/)
 *
 *   Cache::config('default', array(
 *      'engine' => 'Xcache', //[required]
 *      'duration'=> 3600, //[optional]
 *      'probability'=> 100, //[optional]
 *      'prefix' => Inflector::slug(APP_DIR) . '_', //[optional] prefix every cache file with this string
 *      'user' => 'user', //user from xcache.admin.user settings
 *      'password' => 'password', //plaintext password (xcache.admin.pass)
 *  ));
 *
 * Memcache (http://memcached.org/)
 *
 *   Cache::config('default', array(
 *      'engine' => 'Memcache', //[required]
 *      'duration'=> 3600, //[optional]
 *      'probability'=> 100, //[optional]
 *      'prefix' => Inflector::slug(APP_DIR) . '_', //[optional]  prefix every cache file with this string
 *      'servers' => array(
 *          '127.0.0.1:11211' // localhost, default port 11211
 *      ), //[optional]
 *      'persistent' => true, // [optional] set this to false for non-persistent connections
 *      'compress' => false, // [optional] compress data in Memcache (slower, but uses less memory)
 *  ));
 *
 *  Wincache (http://php.net/wincache)
 *
 *   Cache::config('default', array(
 *      'engine' => 'Wincache', //[required]
 *      'duration'=> 3600, //[optional]
 *      'probability'=> 100, //[optional]
 *      'prefix' => Inflector::slug(APP_DIR) . '_', //[optional]  prefix every cache file with this string
 *  ));
 *
 * Redis (http://http://redis.io/)
 *
 *   Cache::config('default', array(
 *      'engine' => 'Redis', //[required]
 *      'duration'=> 3600, //[optional]
 *      'probability'=> 100, //[optional]
 *      'prefix' => Inflector::slug(APP_DIR) . '_', //[optional]  prefix every cache file with this string
 *      'server' => '127.0.0.1' // localhost
 *      'port' => 6379 // default port 6379
 *      'timeout' => 0 // timeout in seconds, 0 = unlimited
 *      'persistent' => true, // [optional] set this to false for non-persistent connections
 *  ));
 */
Cache::config('default', array('engine' => 'File'));

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 *
 * App::build(array(
 *     'Model'                     => array('/path/to/models', '/next/path/to/models'),
 *     'Model/Behavior'            => array('/path/to/behaviors', '/next/path/to/behaviors'),
 *     'Model/Datasource'          => array('/path/to/datasources', '/next/path/to/datasources'),
 *     'Model/Datasource/Database' => array('/path/to/databases', '/next/path/to/database'),
 *     'Model/Datasource/Session'  => array('/path/to/sessions', '/next/path/to/sessions'),
 *     'Controller'                => array('/path/to/controllers', '/next/path/to/controllers'),
 *     'Controller/Component'      => array('/path/to/components', '/next/path/to/components'),
 *     'Controller/Component/Auth' => array('/path/to/auths', '/next/path/to/auths'),
 *     'Controller/Component/Acl'  => array('/path/to/acls', '/next/path/to/acls'),
 *     'View'                      => array('/path/to/views', '/next/path/to/views'),
 *     'View/Helper'               => array('/path/to/helpers', '/next/path/to/helpers'),
 *     'Console'                   => array('/path/to/consoles', '/next/path/to/consoles'),
 *     'Console/Command'           => array('/path/to/commands', '/next/path/to/commands'),
 *     'Console/Command/Task'      => array('/path/to/tasks', '/next/path/to/tasks'),
 *     'Lib'                       => array('/path/to/libs', '/next/path/to/libs'),
 *     'Locale'                    => array('/path/to/locales', '/next/path/to/locales'),
 *     'Vendor'                    => array('/path/to/vendors', '/next/path/to/vendors'),
 *     'Plugin'                    => array('/path/to/plugins', '/next/path/to/plugins'),
 * ));
 *
 */

/**
 * Custom Inflector rules, can be set to correctly pluralize or singularize table, model, controller names or whatever other
 * string is passed to the inflection functions
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */

/**
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. make sure you read the documentation on CakePlugin to use more
 * advanced ways of loading plugins
 *
 * CakePlugin::loadAll(); // Loads all plugins at once
 * CakePlugin::load('DebugKit'); //Loads a single plugin named DebugKit
 *
 */
App::import('Vendor', 'debuglib');
App::import('Vendor', 'markdown');
CakePlugin::load(array(
        'Exception' => array('bootstrap' => true),
        'Setting' => array('bootstrap' => true),
    ));
CakePlugin::loadAll();

/**
 * You can attach event listeners to the request lifecyle as Dispatcher Filter . By Default CakePHP bundles two filters:
 *
 * - AssetDispatcher filter will serve your asset files (css, images, js, etc) from your themes and plugins
 * - CacheDispatcher filter will read the Cache.check configure variable and try to serve cached content generated from controllers
 *
 * Feel free to remove or add filters as you see fit for your application. A few examples:
 *
 * Configure::write('Dispatcher.filters', array(
 *      'MyCacheFilter', //  will use MyCacheFilter class from the Routing/Filter package in your app.
 *      'MyPlugin.MyFilter', // will use MyFilter class from the Routing/Filter package in MyPlugin plugin.
 *      array('callable' => $aFunction, 'on' => 'before', 'priority' => 9), // A valid PHP callback type to be called on beforeDispatch
 *      array('callable' => $anotherMethod, 'on' => 'after'), // A valid PHP callback type to be called on afterDispatch
 *
 * ));
 */
Configure::write('Dispatcher.filters', array(
        'AssetDispatcher',
        'CacheDispatcher'
    ));

/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
        'engine' => 'Yalog.RotateFileLog',
        'types' => array('notice', 'info', 'debug'),
        'file' => 'debug',
    ));
CakeLog::config('error', array(
        'engine' => 'Yalog.RotateFileLog',
        'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
        'file' => 'error',
    ));

/**
 * Filebinderのファイル保存パス
 */
define('FILE_PATH', WWW_ROOT . 'files/');

// アップロードファイルサイズ上限
define('MAX_FILE_SIZE', '10MB');

// ステータスタイプ(OPEN系/CLOSE系
define('STATUS_TYPE_OPEN', 'open');
define('STATUS_TYPE_CLOSE', 'close');
Configure::write('status_types', array(
        STATUS_TYPE_OPEN => __('Status Type Open'),
        STATUS_TYPE_CLOSE => __('Status Type Close'),
    ));

/**
 * Setting plugin
 */
Configure::write('Setting.settings', array(
        'status_open_default' => array(
            'rule' => array('notempty'),
            'default' => __('Article Status Notouch'),
        ),
        'status_close_default' => array(
            'rule' => array('notempty'),
            'default' => __('Article Status Complete'),
        ),
        'btn_label_ok_and_upload_default' => array(
            'rule' => array('notempty'),
            'default' => __('Author Policy OK And Upload'),
        ),
        'btn_label_ok_default' => array(
            'rule' => array('notempty'),
            'default' => __('Author Policy OK'),
        ),
        'btn_label_ng_default' => array(
            'rule' => array('notempty'),
            'default' => __('Author Policy NG'),
        ),
        // 案件インポートプラグイン設定 Import Plugins
        'import_plugins' => array(
            'rule' => array('notempty'),
            'default' => json_encode(array('ImportDefault')),
        ),
        // 案件登録時に発動するフィルタープラグイン設定 Filter Plugins
        'filter_plugins' => array(
            'rule' => array('notempty'),
            'default' => json_encode(array(
                    'FilterScpj',
                    'FilterSherpaRomeo',
                    'FilterLocal'
                )),
        ),
        // 案件の検索結果に対して一括処理を行うプラグイン設定 Bulk Plugins
        'bulk_plugins' => array(
            'rule' => array('notempty'),
            'default' => json_encode(array(
                    'BulkStatusChange',
                    'ExportDefault',
                )),
        )
    ));

// 文字列切り捨て時の末尾
define('STRTRIM_SUFFIX', '...');

// ポリシーカラー
define('ARTICLE_POLICY_COLOR_GREEN', 'green');
define('ARTICLE_POLICY_COLOR_BLUE', 'blue');
define('ARTICLE_POLICY_COLOR_YELLOW', 'yellow');
define('ARTICLE_POLICY_COLOR_WHITE', 'white');
define('ARTICLE_POLICY_COLOR_GRAY', 'gray');
Configure::write('Article.policy_colors', array(
        ARTICLE_POLICY_COLOR_GREEN => __('Green'),
        ARTICLE_POLICY_COLOR_BLUE => __('Blue'),
        ARTICLE_POLICY_COLOR_YELLOW => __('Yellow'),
        ARTICLE_POLICY_COLOR_WHITE => __('White'),
        ARTICLE_POLICY_COLOR_GRAY => __('Gray'),
    ));

Configure::write('Article.policy_color_descriptions', array(
        ARTICLE_POLICY_COLOR_GREEN => __('Description Green'),
        ARTICLE_POLICY_COLOR_BLUE => __('Description Blue'),
        ARTICLE_POLICY_COLOR_YELLOW => __('Description Yellow'),
        ARTICLE_POLICY_COLOR_WHITE => __('Description White'),
        ARTICLE_POLICY_COLOR_GRAY => __('Description Gray'),
    ));

// 著者許諾結果
define('ARTICLE_AUTHOR_POLICY_OK', 'ok');
define('ARTICLE_AUTHOR_POLICY_OK_AND_UPLOAD', 'ok_and_upload');
define('ARTICLE_AUTHOR_POLICY_NG', 'ng');

define('ARTICLE_AUTHOR_POLICY_NOT_NULL', 'not_null'); // 著者が何かしらの意志表示をしたもの

Configure::write('Article.author_policies', array(
        ARTICLE_AUTHOR_POLICY_OK => __('Author Policy OK'),
        ARTICLE_AUTHOR_POLICY_OK_AND_UPLOAD => __('Author Policy OK And Upload'),
        ARTICLE_AUTHOR_POLICY_NG => __('Author Policy NG'),
    ));

// 許諾依頼手段
define('ARTICLE_REQUEST_METHOD_TEL', 'tel');
define('ARTICLE_REQUEST_METHOD_FAX', 'fax');
define('ARTICLE_REQUEST_METHOD_EMAIL', 'email');
define('ARTICLE_REQUEST_METHOD_DOC', 'doc');
define('ARTICLE_REQUEST_METHOD_OTHER', 'other');
Configure::write('Article.request_methods', array(
        ARTICLE_REQUEST_METHOD_TEL => __('Request Method Tel'),
        ARTICLE_REQUEST_METHOD_FAX => __('Request Method Fax'),
        ARTICLE_REQUEST_METHOD_EMAIL => __('Request Method Email'),
        ARTICLE_REQUEST_METHOD_DOC => __('Request Method Doc'),
        ARTICLE_REQUEST_METHOD_OTHER => __('Request Method Other'),
    ));

// 共著者許諾有無
define('ARTICLE_COAUTHOER_FLG_ENABLE', 1);
define('ARTICLE_COAUTHOER_FLG_DISABLE', 0);
Configure::write('Article.coauthor_flgs', array(
        ARTICLE_COAUTHOER_FLG_DISABLE => __('Coauthor Flg Disable'),
        ARTICLE_COAUTHOER_FLG_ENABLE => __('Coauthor Flg Enable'),
    ));

// language.iso
define('ARTICLE_LANGUAGE_ISO_JA', 'ja');
define('ARTICLE_LANGUAGE_ISO_EN', 'en');
define('ARTICLE_LANGUAGE_ISO_CH', 'ch');
define('ARTICLE_LANGUAGE_ISO_KO', 'ko');
define('ARTICLE_LANGUAGE_ISO_FR', 'fr');
define('ARTICLE_LANGUAGE_ISO_DE', 'de');
define('ARTICLE_LANGUAGE_ISO_IT', 'it');
define('ARTICLE_LANGUAGE_ISO_ES', 'es');
define('ARTICLE_LANGUAGE_ISO_RU', 'ru');
define('ARTICLE_LANGUAGE_ISO_AR', 'ar');
define('ARTICLE_LANGUAGE_ISO_PT', 'pt');
define('ARTICLE_LANGUAGE_ISO_OTHER', 'other');
define('ARTICLE_LANGUAGE_ISO_NA', 'N/A');
Configure::write('Article.language_isos', array(
        ARTICLE_LANGUAGE_ISO_JA => ARTICLE_LANGUAGE_ISO_JA,
        ARTICLE_LANGUAGE_ISO_EN => ARTICLE_LANGUAGE_ISO_EN,
        ARTICLE_LANGUAGE_ISO_CH => ARTICLE_LANGUAGE_ISO_CH,
        ARTICLE_LANGUAGE_ISO_KO => ARTICLE_LANGUAGE_ISO_KO,
        ARTICLE_LANGUAGE_ISO_FR => ARTICLE_LANGUAGE_ISO_FR,
        ARTICLE_LANGUAGE_ISO_DE => ARTICLE_LANGUAGE_ISO_DE,
        ARTICLE_LANGUAGE_ISO_IT => ARTICLE_LANGUAGE_ISO_IT,
        ARTICLE_LANGUAGE_ISO_ES => ARTICLE_LANGUAGE_ISO_ES,
        ARTICLE_LANGUAGE_ISO_RU => ARTICLE_LANGUAGE_ISO_RU,
        ARTICLE_LANGUAGE_ISO_AR => ARTICLE_LANGUAGE_ISO_AR,
        ARTICLE_LANGUAGE_ISO_PT => ARTICLE_LANGUAGE_ISO_PT,
        ARTICLE_LANGUAGE_ISO_OTHER => ARTICLE_LANGUAGE_ISO_OTHER,
        ARTICLE_LANGUAGE_ISO_NA => ARTICLE_LANGUAGE_ISO_NA,
    ));

// language.iso639-2
define('ARTICLE_LANGUAGE_ISO639_2_JPN', 'jpn');
define('ARTICLE_LANGUAGE_ISO639_2_ENG', 'eng');
define('ARTICLE_LANGUAGE_ISO639_2_CHI', 'chi');
define('ARTICLE_LANGUAGE_ISO639_2_KOR', 'kor');
define('ARTICLE_LANGUAGE_ISO639_2_FRE', 'fre');
define('ARTICLE_LANGUAGE_ISO639_2_GER', 'ger');
define('ARTICLE_LANGUAGE_ISO639_2_ITA', 'ita');
define('ARTICLE_LANGUAGE_ISO639_2_SPA', 'spa');
define('ARTICLE_LANGUAGE_ISO639_2_RUS', 'rus');
define('ARTICLE_LANGUAGE_ISO639_2_ARA', 'ara');
define('ARTICLE_LANGUAGE_ISO639_2_POR', 'por');
define('ARTICLE_LANGUAGE_ISO639_2_OTHER', 'other');
define('ARTICLE_LANGUAGE_ISO639_2_UND', 'und');
Configure::write('Article.language_iso639_2s', array(
        ARTICLE_LANGUAGE_ISO639_2_JPN => ARTICLE_LANGUAGE_ISO639_2_JPN,
        ARTICLE_LANGUAGE_ISO639_2_ENG => ARTICLE_LANGUAGE_ISO639_2_ENG,
        ARTICLE_LANGUAGE_ISO639_2_CHI => ARTICLE_LANGUAGE_ISO639_2_CHI,
        ARTICLE_LANGUAGE_ISO639_2_KOR => ARTICLE_LANGUAGE_ISO639_2_KOR,
        ARTICLE_LANGUAGE_ISO639_2_FRE => ARTICLE_LANGUAGE_ISO639_2_FRE,
        ARTICLE_LANGUAGE_ISO639_2_GER => ARTICLE_LANGUAGE_ISO639_2_GER,
        ARTICLE_LANGUAGE_ISO639_2_ITA => ARTICLE_LANGUAGE_ISO639_2_ITA,
        ARTICLE_LANGUAGE_ISO639_2_SPA => ARTICLE_LANGUAGE_ISO639_2_SPA,
        ARTICLE_LANGUAGE_ISO639_2_RUS => ARTICLE_LANGUAGE_ISO639_2_RUS,
        ARTICLE_LANGUAGE_ISO639_2_ARA => ARTICLE_LANGUAGE_ISO639_2_ARA,
        ARTICLE_LANGUAGE_ISO639_2_POR => ARTICLE_LANGUAGE_ISO639_2_POR,
        ARTICLE_LANGUAGE_ISO639_2_OTHER => ARTICLE_LANGUAGE_ISO639_2_OTHER,
        ARTICLE_LANGUAGE_ISO639_2_UND => ARTICLE_LANGUAGE_ISO639_2_UND,
    ));

// publicationstatus
define('ARTICLE_PUBLICATIONSTATUS_PUBLISHED', 'published');
define('ARTICLE_PUBLICATIONSTATUS_UNPUBLISHED', 'unpublished');
Configure::write('Article.publicationstatuses', array(
        ARTICLE_PUBLICATIONSTATUS_PUBLISHED => ARTICLE_PUBLICATIONSTATUS_PUBLISHED,
        ARTICLE_PUBLICATIONSTATUS_UNPUBLISHED => ARTICLE_PUBLICATIONSTATUS_UNPUBLISHED,
    ));

// peerreviewed
define('ARTICLE_PEERREVIEWED_UNREFEREED', 'unrefereed');
define('ARTICLE_PEERREVIEWED_REFEREED', 'refereed');
Configure::write('Article.peerrevieweds', array(
        ARTICLE_PEERREVIEWED_UNREFEREED => ARTICLE_PEERREVIEWED_UNREFEREED,
        ARTICLE_PEERREVIEWED_REFEREED => ARTICLE_PEERREVIEWED_REFEREED,
    ));

// type.nii
define('ARTICLE_TYPE_NII_JOURNAL_ARTICLE', 'Journal Article');
define('ARTICLE_TYPE_NII_THESIS_OR_DISSERTATION', 'Thesis or Dissertation');
define('ARTICLE_TYPE_NII_DEPARTMENTAL_BULLETIN_PAPER', 'Departmental Bulletin Paper');
define('ARTICLE_TYPE_NII_CONFERENCE_PAPER', 'Conference Paper');
define('ARTICLE_TYPE_NII_PRESENTATION', 'Presentation');
define('ARTICLE_TYPE_NII_BOOK', 'Book');
define('ARTICLE_TYPE_NII_TECHNICAL_REPORT', 'Technical Report');
define('ARTICLE_TYPE_NII_RESEARCH_PAPER', 'Research Paper');
define('ARTICLE_TYPE_NII_ARTICLE', 'Article');
define('ARTICLE_TYPE_NII_PREPRINT', 'Preprint');
define('ARTICLE_TYPE_NII_LEARNING_MATERIAL', 'Learning Material');
define('ARTICLE_TYPE_NII_DATA_OR_DATASET', 'Data or Dataset');
define('ARTICLE_TYPE_NII_SOFTWARE', 'Software');
define('ARTICLE_TYPE_NII_OTHERS', 'Others');
Configure::write('Article.type_niis', array(
        ARTICLE_TYPE_NII_JOURNAL_ARTICLE => ARTICLE_TYPE_NII_JOURNAL_ARTICLE,
        ARTICLE_TYPE_NII_THESIS_OR_DISSERTATION => ARTICLE_TYPE_NII_THESIS_OR_DISSERTATION,
        ARTICLE_TYPE_NII_DEPARTMENTAL_BULLETIN_PAPER => ARTICLE_TYPE_NII_DEPARTMENTAL_BULLETIN_PAPER,
        ARTICLE_TYPE_NII_CONFERENCE_PAPER => ARTICLE_TYPE_NII_CONFERENCE_PAPER,
        ARTICLE_TYPE_NII_PRESENTATION => ARTICLE_TYPE_NII_PRESENTATION,
        ARTICLE_TYPE_NII_BOOK => ARTICLE_TYPE_NII_BOOK,
        ARTICLE_TYPE_NII_TECHNICAL_REPORT => ARTICLE_TYPE_NII_TECHNICAL_REPORT,
        ARTICLE_TYPE_NII_RESEARCH_PAPER => ARTICLE_TYPE_NII_RESEARCH_PAPER,
        ARTICLE_TYPE_NII_ARTICLE => ARTICLE_TYPE_NII_ARTICLE,
        ARTICLE_TYPE_NII_PREPRINT => ARTICLE_TYPE_NII_PREPRINT,
        ARTICLE_TYPE_NII_LEARNING_MATERIAL => ARTICLE_TYPE_NII_LEARNING_MATERIAL,
        ARTICLE_TYPE_NII_DATA_OR_DATASET => ARTICLE_TYPE_NII_DATA_OR_DATASET,
        ARTICLE_TYPE_NII_SOFTWARE => ARTICLE_TYPE_NII_SOFTWARE,
        ARTICLE_TYPE_NII_OTHERS => ARTICLE_TYPE_NII_OTHERS,
    ));

// textversion
define('ARTICLE_TEXT_VERSION_PUBLISHER', 'publisher');
define('ARTICLE_TEXT_VERSION_AUTHOR', 'author');
define('ARTICLE_TEXT_VERSION_NONE', 'none');
Configure::write('Article.textversions', array(
        ARTICLE_TEXT_VERSION_PUBLISHER => ARTICLE_TEXT_VERSION_PUBLISHER,
        ARTICLE_TEXT_VERSION_AUTHOR => ARTICLE_TEXT_VERSION_AUTHOR,
        ARTICLE_TEXT_VERSION_NONE => ARTICLE_TEXT_VERSION_NONE,
    ));

// author_coauthor_flg
Configure::write('Article.author_coauthor_flgs', array(
        true => __('Coauthor Flg Enable'),
        false => __('Coauthor Flg Disable'),
    ));

// 公開可能バージョン publisher_open_file_version
define('PUBLISHER_OPEN_FILE_VERSION_PUBLISHER', 'publisher');
define('PUBLISHER_OPEN_FILE_VERSION_AUTHOR', 'author');
define('PUBLISHER_OPEN_FILE_VERSION_PREPRINT', 'preprint');
define('PUBLISHER_OPEN_FILE_VERSION_DISABLED', 'disabled');
define('PUBLISHER_OPEN_FILE_VERSION_UNCLEAR', 'unclear');
Configure::write('Article.publisher_open_file_versions', array(
        PUBLISHER_OPEN_FILE_VERSION_DISABLED => __('Publisher Open File Version Disabled'),
        PUBLISHER_OPEN_FILE_VERSION_PREPRINT => __('Publisher Open File Version Preprint'),
        PUBLISHER_OPEN_FILE_VERSION_AUTHOR => __('Publisher Open File Version Author'),
        PUBLISHER_OPEN_FILE_VERSION_PUBLISHER => __('Publisher Open File Version Publisher'),
        PUBLISHER_OPEN_FILE_VERSION_UNCLEAR => __('Publisher Open File Version Unclear'),
    ));

// 許諾ボタン表示タイプ btn_display_type
define('PAGE_CONTENT_BTN_DISPLAY_TYPE_ALL', 'all');
define('PAGE_CONTENT_BTN_DISPLAY_TYPE_OK_AND_NG', 'ok_and_ng');
define('PAGE_CONTENT_BTN_DISPLAY_TYPE_UPLOAD_AND_NG', 'upload_and_ng');
Configure::write('PageContent.btn_display_types', array(
        PAGE_CONTENT_BTN_DISPLAY_TYPE_ALL => __('Btn Display Type All'),
        PAGE_CONTENT_BTN_DISPLAY_TYPE_OK_AND_NG => __('Btn Display Type OK And NG'),
        PAGE_CONTENT_BTN_DISPLAY_TYPE_UPLOAD_AND_NG => __('Btn Display Type Upload And NG'),
    ));

Configure::write('DebugMemo.email_subject_prefix', '[CSI Project]');