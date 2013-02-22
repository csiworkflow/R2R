<?php
App::uses('ModelBehavior', 'Model');
App::uses('SherpaRomeo', 'FilterSherpaRomeo.Lib');

class SherpaRomeoBehavior extends ModelBehavior {

    public $settings = array();

    private $__defaults = array(
        'url' => array(
            'search' => 'http://www.sherpa.ac.uk/romeo/api29.php',
        ),
        'path' => array(
            'society' => '/society',
            'journal' => '/journal',
        ),
        'limit' => 1,
    );

    private $SherpaRomeo = null;

    /**
     * setup
     *
     * @param type $model
     * @param type $config
     */
    public function setup(Model $model, $config = array()) {
        // 設定の取り込み
        $this->settings = Set::merge($this->settings, array( $model->alias => $this->__defaults ));
        if ( !empty($config) ) {
            $this->settings = Set::merge($this->settings, array($model->alias => $config));
        }

        // Sherpa Library の読み込み
        $this->SherpaRomeo = new SherpaRomeo();
    }

    /**
     * 雑誌名からキーワード検索
     * sherpaJournalKeyword
     *
     * @param type $keyword
     * @access public
     * @return array
     */
    public function sherpaJournalKeyword(Model $model, $keyword) {
        if ( empty($keyword) ) {
            return false;
        }

        // 基本のURL
        $url = $this->settings[$model->alias]['url']['search'];

        $result = $this->SherpaRomeo->journalKeyword($url, $keyword, $this->settings[$model->alias]['limit']);

        return $result;
    }

    /**
     * ISSNから検索
     * sherpaJournalIssn
     *
     * @param type $issn
     * @access public
     * @return array
     */
    public function sherpaJournalIssn(Model $model, $issn) {
        if ( empty($issn) ) {
            return false;
        }

        // 基本のURL
        $url = $this->settings[$model->alias]['url']['search']
              .$this->settings[$model->alias]['path']['journal'];

        $result = $this->SherpaRomeo->journalIssn($url, $issn, $this->settings[$model->alias]['limit']);

        return $result;
    }

    /**
     * 出版社学協会名からキーワード検索
     * sherpaPublisherKeyword
     *
     * @param type $keyword
     * @access public
     * @return array
     */
    public function sherpaPublisherKeyword(Model $model, $keyword) {
        if ( empty($keyword) ) {
            return false;
        }

        // 基本のURL
        $url = $this->settings[$model->alias]['url']['search'];

        $result = $this->SherpaRomeo->publisherKeyword($url, $keyword, $this->settings[$model->alias]['limit']);

        return $result;
    }

}