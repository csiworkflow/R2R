<?php
App::uses('Common', 'FilterScpj.Lib');

class Scpj extends Common {

    /**
     * 学協会名からキーワード検索
     * societyKeyword
     *
     * @param type $keyword
     * @access public
     * @return array
     */
    public function societyKeyword($url = null, $keyword = null, $limit = 1) {
        if ( empty($keyword) || empty($url) ) {
            return false;
        }

        // APIパラメータの初期値
        $params = array(
            'keyword' => urlencode($keyword),
            'format' => 'xml',   // XMLフォーマットで取得
        );

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
        if ( !$this->__isScpjNotFound($array) ) {
            return false;
        }

        // 抽出件数１件の場合、$array['scpjapi']['publishers']['publisher']の直下にレコードが入る。
        // 取り扱いがややこしくなるので１件の場合は[0]に入れ直して階層数を同じにする
        if ( !empty($array['scpjapi']['header']['numhits']) && $array['scpjapi']['header']['numhits'] == 1 ) {
            $data = $array['scpjapi']['publishers']['publisher'];
            unset($array['scpjapi']['publishers']['publisher']);
            $array['scpjapi']['publishers']['publisher'][0] = $data;
        }

        // 指定件数以上該当した場合はエラーとする
        if ( count($array['scpjapi']['publishers']['publisher']) != $limit ) {
            return false;
        }

        // XMLから必要なFieldを抽出する
        $result = array();
        $result = $this->_salvageData($array, $result);

        return $result;
    }

    /**
     * 雑誌名からキーワード検索
     * journalKeyword
     *
     * @param type $keyword
     * @access public
     * @return array
     */
    public function journalKeyword($url = null, $keyword = null, $limit = 1) {
        if ( empty($keyword) || empty($url) ) {
            return false;
        }

        // APIパラメータの初期値
        $params = array(
            'keyword' => urlencode($keyword),
            'format' => 'xml',   // XMLフォーマットで取得
        );

        $result = $this->__getJournal($url, $params, $limit);
        return $result;
    }

    /**
     * ISSNから検索
     * journalIssn
     *
     * @param type $issn
     * @access public
     * @return array
     */
    public function journalIssn($url = null, $issn = null, $limit = 1) {
        if ( empty($issn) || empty($url) ) {
            return false;
        }

        // APIパラメータの初期値
        $params = array(
            'issn' => urlencode($issn),
            'format' => 'xml',   // XMLフォーマットで取得
        );

        $result = $this->__getJournal($url, $params, $limit);
        return $result;
    }

    /**
     * journalKeywordとjournalIssnで共有してるメソッド
     * __getJournal
     *
     * @param type $params
     * @param type $limit
     * @return boolean|array
     */
    private function __getJournal($url = null, $params = array(), $limit = 1) {
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
        if ( !$this->__isScpjNotFound($array) ) {
            return false;
        }

        // 抽出件数１件の場合、$array['scpjapi']['journals']['journal']の直下にレコードが入る。
        // 取り扱いがややこしくなるので１件の場合は[0]に入れ直して階層数を同じにする
        if ( !empty($array['scpjapi']['header']['numhits']) && $array['scpjapi']['header']['numhits'] == 1 ) {
            $data = $array['scpjapi']['journals']['journal'];
            unset($array['scpjapi']['journals']['journal']);
            $array['scpjapi']['journals']['journal'][0] = $data;
        }

        // 指定件数以上該当した場合はエラーとする
        if ( count($array['scpjapi']['journals']['journal']) != $limit ) {
            return false;
        }

        // XMLから必要なFieldを抽出する
        $result = array();
        $result = $this->_salvageData($array, $result);

        return $result;
    }

    /**
     * SCPJのNotFound判定
     * __isScpjNotFound
     *
     * @param type $array
     * @access private
     * @return boolean
     */
    private function __isScpjNotFound($array = array()) {
        if ( isset($array['scpjapi']['header']['outcome']) && $array['scpjapi']['header']['outcome'] == 'notFound' ) {
            return false;
        }

        return true;
    }

    /**
     * detail
     *
     * @param type $searchTarget
     * @param type $id
     */
    public function detail($url, $id, $prefix = 'S') {

        if ( empty($url) || empty($id) ) {
            return false;
        }

        if (substr($id, 0,1) === $prefix) {
            $url .= '/id/' . $id;
        } else {
            // 旧ID対策
            $url .= '/id/' . sprintf($prefix . '%06d', $id);
        }

        // APIパラメータの初期値
        $params = array(
            'format' => 'xml',   // XMLフォーマットで取得
        );
        $queryUrl = $this->_setparams($url, $params);

        // XMLを取得
        try {
            $xml = Xml::build($queryUrl);
            $array = Set::reverse($xml);
        } catch (Exception $e) {
            return false;
        }

        if ( isset($array['scpjapi']['header']['outcome']) && $array['scpjapi']['header']['outcome'] == 'notFound' ) {
            return false;
        }

        $result = array();
        $result = $this->_salvageData($array, $result);

        $result['detail_url'] = $url;

        return $result;
    }

}
