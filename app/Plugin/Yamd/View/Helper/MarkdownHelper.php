<?php
App::uses('AppHelper', 'View/Helper');
App::uses('Folder', 'Utility');
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

    public $cacheConfigName = 'yamd';

    public function __construct($View, $options = array()) {
        $this->settings['markdownFilePath'] = APP . 'View' . DS . 'Elements' . DS . 'markdown' . DS;
        $this->settings['cachePath'] = TMP . 'cache' . DS . 'yamd' . DS;
        $this->settings = array_merge($this->settings, $options);

        $obj = new Folder($this->settings['cachePath'], true, 0777);
        Cache::config($this->settings['cacheConfig'], array('engine'=>'File', 'path' => $this->settings['cachePath']));
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
        if (Configure::read('debug') == 0 && Cache::read($markdownFile, $this->settings['cacheConfig'])) {
            return Cache::read($markdownFile, $this->settings['cacheConfig']);
        }
        foreach ($exts as $ext) {
            if (file_exists($this->settings['markdownFilePath'] . $markdownFile . $ext)) {
                $php = $this->htmlize(file_get_contents($this->settings['markdownFilePath'] . $markdownFile . $ext));
                file_put_contents($this->settings['tempPath'] . $markdownFile, $php);
                ob_start();
                extract($viewVars);
                include $this->settings['tempPath'] . $markdownFile;
                $html = ob_get_clean();
                Cache::write($markdownFile, $html, $this->settings['cacheConfig']);
                return $html;
            }
        }
    }

    protected function _getExtensions() {
        $exts = $this->settings['ext'];
        return $exts;
    }
}