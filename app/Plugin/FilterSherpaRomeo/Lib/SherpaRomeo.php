<?php

App::uses('Common', 'FilterSherpaRomeo.Lib');

class SherpaRomeo extends Common {

    /**
     * 雑誌名からキーワード検索
     * journalKeyword
     *
     * @param type $keyword
     * @access public
     * @return array
     */
    public function journalKeyword($url=null, $keyword=null, $limit=1) {
        if ( empty($keyword) || empty($url) ) {
            return false;
        }

        // APIパラメータの初期値
        $params = array(
            'jtitle' => urlencode($keyword),
            'versions' => 'all',
        );

        return $this->__getJournal($url, $params, $limit);
    }

    /**
     * ISSNから検索
     * journalIssn
     *
     * @param type $issn
     * @access public
     * @return array
     */
    public function journalIssn($url=null, $issn=null, $limit=1) {
        if ( empty($issn) || empty($url) ) {
            return false;
        }

        // APIパラメータの初期値
        $params = array(
            'issn' => urlencode($issn),
            'versions' => 'all',
        );

        return $this->__getJournal($url, $params, $limit);
    }

    /**
     * 出版社/学協会名からキーワード検索
     * publisherKeyword
     *
     * @param type $keyword
     * @access public
     * @return array
     */
    public function publisherKeyword($url=null, $keyword=null, $limit=1) {
        if ( empty($keyword) || empty($url) ) {
            return false;
        }

        // APIパラメータの初期値
        $params = array(
            'pub' => urlencode($keyword),
            'versions' => 'all',
        );

        return $this->__getPublisher($url, $params, $limit);
    }

    /**
     * journalKeywordとjournalIssnで共有してるメソッド
     * __getJournal
     *
     * @param type $params
     * @param type $limit
     * @return boolean|array
     */
    private function __getJournal($url=null, $params=array(), $limit=1) {
        if ( empty($params) || empty($url) ) {
            return false;
        }

        // URLにパラメータを展開
        $url = $this->_setparams($url, $params);

        // XMLを取得
        try {
            $xml = Xml::build($url);
            $array = Set::reverse($xml);
        } catch (Exception $e) {
            return false;
        }

        // 検索対象が無い場合
        if ( !$this->__isSherpaNotFound($array) ) {
            return false;
        }

        // 抽出件数１件の場合、$array['romeoapi']['journals']['journal']の直下にレコードが入る。
        // 取り扱いがややこしくなるので１件の場合は[0]に入れ直して階層数を同じにする
        if ( !empty($array['romeoapi']['header']['numhits']) && $array['romeoapi']['header']['numhits'] == 1 ) {
            $data = $array['romeoapi']['journals']['journal'];
            unset($array['romeoapi']['journals']['journal']);
            $array['romeoapi']['journals']['journal'][0] = $data;
        }

        // 指定件数以上該当した場合はエラーとする
        if ( count($array['romeoapi']['journals']['journal']) != $limit ) {
            return false;
        }

        // XMLから必要なFieldを抽出する
        $result = array();
        $result = $this->_salvageData($array, $result);
        return $result;
    }

    /**
     * __getPublisher
     *
     * @param type $params
     * @param type $limit
     * @return boolean|array
     */
    private function __getPublisher($url=null, $params=array(), $limit=1) {
        if ( empty($params) || empty($url) ) {
            return false;
        }

        // URLにパラメータを展開
        $url = $this->_setparams($url, $params);

        // XMLを取得
        try {
            $xml = Xml::build($url);
            $array = Set::reverse($xml);
        } catch (Exception $e) {
            return false;
        }

        // 検索対象が無い場合
        if ( !$this->__isSherpaNotFound($array) ) {
            return false;
        }

        // 抽出件数１件の場合、$array['romeoapi']['publishers']['publisher']の直下にレコードが入る。
        // 取り扱いがややこしくなるので１件の場合は[0]に入れ直して階層数を同じにする
        if ( !empty($array['romeoapi']['header']['numhits']) && $array['romeoapi']['header']['numhits'] == 1 ) {
            $data = $array['romeoapi']['publishers']['publisher'];
            unset($array['romeoapi']['publishers']['publisher']);
            $array['romeoapi']['publishers']['publisher'][0] = $data;
        }

        // 指定件数以上該当した場合はエラーとする
        if ( count($array['romeoapi']['publishers']['publisher']) != $limit ) {
            return false;
        }

        // XMLから必要なFieldを抽出する
        $result = array();
        $result = $this->_salvageData($array, $result);
        return $result;
    }

    /**
     * SCPJのNotFound判定
     * __isSherpaNotFound
     *
     * @param type $array
     * @access private
     * @return boolean
     */
    private function __isSherpaNotFound($array=array()) {
        if ( isset($array['romeoapi']['header']['outcome']) ) {
            if (
                $array['romeoapi']['header']['outcome'] == 'notFound' ||
                $array['romeoapi']['header']['outcome'] == 'failed'
               ) {
                return false;
            }
        }
        return true;
    }
}
