<?php
App::uses('SherpaRomeo', 'FilterSherpaRomeo.Lib');

class FilterSherpaRomeo extends FilterSherpaRomeoAppModel {

    public $useTable = false;
    public $actsAs = array('FilterSherpaRomeo.SherpaRomeo');

    /**
     * filter
     *
     * @param $data
     */
    public function filter($data){

        // 同一掲載誌タイトルで検索
        if (!empty($data['Article']['identifier_title'])) {
            $result = $this->sherpaJournalKeyword($data['Article']['identifier_title']);

            if (isset($result['@id'])) {
                $data['Article']['publisher_source'] = __d('filter_sherpa_romeo', 'SHERPA/ROMEO');
                $data = $this->parse($data, $result);
                return $data;
            }
        }

        // 同一ISSNで検索
        if (!empty($data['Article']['identifier_issn'])) {
            $result = $this->sherpaJournalIssn($data['Article']['identifier_issn']);

            if (isset($result['@id'])) {
                $data['Article']['publisher_source'] = __d('filter_sherpa_romeo', 'SHERPA/ROMEO');
                $data = $this->parse($data, $result);
                return $data;
            }
        }
        return $data;
    }


    private function parse($data, $result) {
        /**
         * Article.publisher_policy
         */
        if ( !empty($result['romeocolour']) ) {
            $data['Article']['publisher_policy'] = strtolower($result['romeocolour']);
        }

        /**
         * Article.publisher_policy_type
         */
        $policyTypes = array(
            'pdfversion', 'preprints', 'postprints'
        );
        $publisher_policy_type = '';
        foreach ($policyTypes as $policyType) {
            if ( !empty($result[$policyType]) ) {
                $publisher_policy_type .= $this->arrayBottomToString($result[$policyType]);
            }
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
        $publisher_open_conditions = '';
        if ( !empty($result['conditions']) ) {
            $publisher_open_conditions .= $this->arrayBottomToString($result['conditions']);
        }

        if ( !empty($publisher_open_conditions) ) {
            // publisher_policyを取得できても既にdataにopen_conditionが設定してあった場合はそれを優先する
            if ( empty($data['Article']['publisher_open_condition']) ) {
                $data['Article']['publisher_open_condition'] = $publisher_open_conditions;
            }
        }

        return $data;
    }

    private function arrayBottomToString($_datas, $string = null) {
        foreach ($_datas as $key => $_data) {
            if ( is_array($_data) ) {
                $string = $this->arrayBottomToString($_data, $string);
            } else {
                if (!empty($_data)) {
                    if (!is_numeric($key)) {
                        $string .= $key . ':' . $_data . "\n";
                    } else {
                        $string .= $_data . "\n";
                    }
                }
            }
        }
        return $string;
    }
}