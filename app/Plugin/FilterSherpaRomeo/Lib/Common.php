<?php

class Common {

    /**
     * salvage対象のField
     *
     * @var array
     */
    protected $__fields = array(
        // publisher
        '@id',
        'name',
        'alias',
        'homeurl',
        'conditions',
        'scpjcolour',

        // journal
        'jtitle',
        'issn',
        'scpjpub',

        // Sherpa専用
        'romeocolour',
        'zetocpub',
        'romeopub',
        'preprints',
        'postprints',
        'pdfversion',
    );

    /**
     * URLパラメータのセット
     * __setparams
     *
     * @param string $url
     * @param type $params
     * @access protected
     * @return string
     */
    protected function _setparams($url, $params=array()) {
        if ( !empty($params) ) {
            $pm = array();
            foreach ($params as $key => $val) {
                $pm[] = $key.'='.$val;
            }
            $url .= '?'.implode('&', $pm);
        }
        return $url;
    }

    /**
     * データの解析
     * __salvageData
     *
     * @param type $_data
     * @param type $fields
     * @param type &$result
     * @access protected
     */
    protected function _salvageData($_data = array(), $result = array()) {

        foreach ($_data as $field => $val) {
            if ( !is_numeric($field) && in_array($field, $this->__fields) ) {
                // 数値以外のFieldで指定Fieldであれば$resultに保管
                $result[$field] = $val;
            } else if ( is_array($val) ) {
                // さらに深い階層に配列であれば再起実行
                $result = $this->_salvageData($val, $result);
            }
        }

        return $result;
    }

}
