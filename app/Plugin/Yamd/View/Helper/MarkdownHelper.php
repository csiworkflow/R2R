<?php
App::uses('AppHelper', 'View/Helper');
App::uses('Folder', 'Utility');
App::uses('L10n', 'I18n');
class MarkdownHelper extends AppHelper {

    public $helpers = array('Html', 'Form');

    public $settings = array(
        'markdownFilePath' => false,
        'cacheConfig' => 'yamd',
        'cachePath' => false,
        'tempPath' => TMP,
        'ext' => array(
            '.md',
            '.markdown',
        ),
    );

    public $l10n = null;
    public $cacheConfigName = 'yamd';

    public function __construct($View, $options = array()) {
        $this->settings['markdownFilePath'] = APP . 'View' . DS . 'Elements' . DS . 'markdown' . DS;
        $this->settings['cachePath'] = TMP . 'cache' . DS . 'yamd' . DS;
        $this->settings = array_merge($this->settings, $options);

        $obj = new Folder($this->settings['cachePath'], true, 0777);
        Cache::config($this->settings['cacheConfig'], array('engine'=>'File', 'path' => $this->settings['cachePath']));
        $this->l10n = new L10n();
        parent::__construct($View, $options);
    }

    /**
     * htmlize
     *
     */
    public function htmlize($markdownText){
        return Markdown($markdownText);
    }

    /**
     * loadFile
     *
     */
    public function loadFile($markdownFile, $viewVars = array()){
        $exts = $this->_getExtensions();
        $language = Configure::read('Config.language');
        $catalog = $this->l10n->catalog($language);
        $lang = $catalog['locale'];
        $cacheKey = $markdownFile . '.' . $lang;

        if (Configure::read('debug') == 0 && Cache::read($cacheKey, $this->settings['cacheConfig'])) {
            return Cache::read($cacheKey, $this->settings['cacheConfig']);
        }
        foreach ($exts as $ext) {
            $filePath = $this->settings['markdownFilePath'] . $lang . DS . $markdownFile . $ext;
            if (file_exists($filePath)) {
                return $this->__loadFile($filePath, $cacheKey, $viewVars);
            }
            $filePath = $this->settings['markdownFilePath'] . $markdownFile . $ext;
            if (file_exists($filePath)) {
                return $this->__loadFile($filePath, $cacheKey, $viewVars);
            }
        }
    }

    /**
     * __loadFile
     *
     * @param $filePath, $cacheKey
     */
    private function __loadFile($filePath, $cacheKey, $viewVars = array()){
        $php = $this->htmlize(file_get_contents($filePath));
        file_put_contents($this->settings['tempPath'] . $cacheKey, $php);
        ob_start();
        extract($viewVars);
        include $this->settings['tempPath'] . $cacheKey;
        $html = ob_get_clean();
        Cache::write($cacheKey, $html, $this->settings['cacheConfig']);
        return $html;
    }

    protected function _getExtensions() {
        $exts = $this->settings['ext'];
        return $exts;
    }
}