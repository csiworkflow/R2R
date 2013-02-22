<?php
App::uses('Scpj', 'FilterScpj.Lib');

class FilterScpj extends FilterScpjAppModel {

    public $useTable = false;
    public $actsAs = array('FilterScpj.Scpj');

    /**
     * filter
     *
     * @param $data
     */
    public function filter($data){

        // 同一掲載誌タイトルで検索
        if (!empty($data['Article']['identifier_title'])) {
            $result = $this->scpjJournalKeyword($data['Article']['identifier_title']);

            if (isset($result['@id'])) {
                $data['Article']['publisher_source'] = __d('filter_scpj', 'SCPJ');
                $detail = $this->scpjJournalDetail($result['@id']);
                $data = $this->parse($data, $detail);
                return $data;
            }
        }

        // 同一ISSNで検索
        if (!empty($data['Article']['identifier_issn'])) {
            $result = $this->scpjJournalIssn($data['Article']['identifier_issn']);

            if (isset($result['@id'])) {
                $data['Article']['publisher_source'] = __d('filter_scpj', 'SCPJ');
                $detail = $this->scpjJournalDetail($result['@id']);
                $data = $this->parse($data, $detail);
                return $data;
            }
        }
        return $data;
    }


    private function parse($data, $result) {

        /**
         * Article.publisher_policy
         */
        if ( !empty($result['scpjcolour']) ) {
            if (is_array($result['scpjcolour'])) {
                if (!empty($result['scpjcolour']['@'])) {
                    $data['Article']['publisher_policy'] = strtolower($result['scpjcolour']['@']);
                } else {
                    throw new InternalErrorException(__('Invalid XML: scpjcolour'));
                }
            } else {
                $data['Article']['publisher_policy'] = strtolower($result['scpjcolour']);
            }
        }

        /**
         * Article.publisher_policy_type
         */
        $targets = array(
            'publishersverion',
        );
        $publisher_policy_type = '';
        if ( !empty($result['conditions']) ) {
            $publisher_policy_type .= $this->parseConditions($result['conditions'], $targets);
        }
        if ( !empty($publisher_policy_type) ) {
            // publisher_policyを取得できても既にdataにpolicy_typeが設定してあった場合はそれを優先する
            if ( empty($data['Article']['publisher_policy_type']) ) {
                $data['Article']['publisher_policy_type'] = $publisher_policy_type;
            }
        }

        /**
         * Article.publisher_open_condition
         */
        $targets = array(
            'restrict', 'location',
        );
        $string = '';
        if ( !empty($result['conditions']) ) {
            $string .= $this->parseConditions($result['conditions'], $targets);
        }
        if ( !empty($string) ) {
            // publisher_policyを取得できても既にdataにopen_conditionが設定してあった場合はそれを優先する
            if ( empty($data['Article']['publisher_open_condition']) ) {
                $data['Article']['publisher_open_condition'] = $string;
            }
        }

        /**
         * Article.publisher_open_condition
         */
        if (!empty($result['detail_url'])) {
            $data['Article']['publisher_source_uri'] = $result['detail_url'];
        }

        return $data;
    }

    private function parseConditions($_datas, $targets, $string = null) {
        foreach ($_datas as $key => $_data) {
            if ( isset($_data['@type']) && isset($_data['@']) ) {
                if ( in_array($_data['@type'], $targets) ) {
                    $string .= $_data['@type'] . ':' . $_data['@'] . "\n";
                }
            } else {
                $string = $this->parseConditions($_data, $targets, $string);
            }
        }
        return $string;
    }


}