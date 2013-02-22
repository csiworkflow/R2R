<?php
App::uses('ModelBehavior', 'Model');
App::uses('Scpj', 'FilterScpj.Lib');

class ScpjBehavior extends ModelBehavior {

    public $settings = array();

    private $__defaults = array(
        'url' => array(
            'search' => 'http://scpj.tulips.tsukuba.ac.jp/search',
            'detail' => 'http://scpj.tulips.tsukuba.ac.jp/detail',
        ),
        'path' => array(
            'society' => '/society',
            'journal' => '/journal',
        ),
        'limit' => 1,
    );

    private $Scpj = null;

    /**
     * setup
     *
     * @param type $model
     * @param type $config
     */
    public function setup($model, $config = array()) {
        // 設定の取り込み
        $this->settings = Set::merge($this->settings, array( $model->alias => $this->__defaults ));
        if ( !empty($config) ) {
            $this->settings = Set::merge($this->settings, array($model->alias => $config));
        }

        // Scpj Library の読み込み
        $this->Scpj = new Scpj();
    }

    /**
     * 学協会名からキーワード検索
     * scpjSocietyKeyword
     *
     * @param type $keyword
     * @access public
     * @return array
     */
    public function scpjSocietyKeyword(Model $model, $keyword) {
        if ( empty($keyword) ) {
            return false;
        }

        // 基本のURL
        $url = $this->settings[$model->alias]['url']['search']
              .$this->settings[$model->alias]['path']['society'];

        $result = $this->Scpj->societyKeyword($url, $keyword, $this->settings[$model->alias]['limit']);

        return $result;
    }

    /**
     * 雑誌名からキーワード検索
     * scpjJournalKeyword
     *
     * @param type $keyword
     * @access public
     * @return array
     */
    public function scpjJournalKeyword(Model $model, $keyword) {
        if ( empty($keyword) ) {
            return false;
        }

        // 基本のURL
        $url = $this->settings[$model->alias]['url']['search']
            . $this->settings[$model->alias]['path']['journal'];

        $result = $this->Scpj->journalKeyword($url, $keyword, $this->settings[$model->alias]['limit']);

        return $result;
    }

    /**
     * ISSNから検索
     * scpjJournalIssn
     *
     * @param type $issn
     * @access public
     * @return array
     */
    public function scpjJournalIssn(Model $model, $issn) {
        if ( empty($issn) ) {
            return false;
        }

        // 基本のURL
        $url = $this->settings[$model->alias]['url']['search']
            . $this->settings[$model->alias]['path']['journal'];

        $result = $this->Scpj->journalIssn($url, $issn, $this->settings[$model->alias]['limit']);
        return $result;
    }

    /**
     * 学協会詳細
     * scpjSocietyDetail
     *
     * @param type $id
     * @access public
     * @return array
     */
    public function scpjSocietyDetail(Model $model, $id) {
        if ( empty($id) ) {
            return false;
        }

        // 基本のURL
        $url = $this->settings[$model->alias]['url']['detail']
            . $this->settings[$model->alias]['path']['society'];

        $result = $this->Scpj->detail($url, $id);

        return $result;
    }

    /**
     * 雑誌詳細
     * scpjJournalDetail
     *
     * @param type $id
     * @access public
     * @return array
     */
    public function scpjJournalDetail(Model $model, $id) {
        if ( empty($id) ) {
            return false;
        }

        // 基本のURL
        $url = $this->settings[$model->alias]['url']['detail']
            . $this->settings[$model->alias]['path']['journal'];

        $result = $this->Scpj->detail($url, $id, 'J');

        return $result;
    }

}