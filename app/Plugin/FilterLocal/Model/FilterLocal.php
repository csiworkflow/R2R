<?php

class FilterLocal extends FilterLocalAppModel {

    public $useTable = false;

    /**
     * filter
     *
     * @param $data
     */
    public function filter($data){
        $this->Journal = ClassRegistry::init('Journal');

        // 同一雑誌タイトルで検索
        if (!empty($data['Article']['identifier_title'])) {
            $query = array();
            $query['conditions'] = array(
                'Journal.title' => $data['Article']['identifier_title'],
            );
            $journal = $this->Journal->find('first', $query);

            $result = $this->__filter($data, $journal);
            if ($result !== false) {
                return $result;
            }
        }

        // 同一ISSNで検索
        if (!empty($data['Article']['identifier_issn'])) {
            $query = array();
            $query['conditions'] = array(
                'Journal.issn' => $data['Article']['identifier_issn'],
            );
            $journal = $this->Journal->find('first', $query);

            $result = $this->__filter($data, $journal);
            if ($result !== false) {
                return $result;
            }
        }

        return $data;
    }

    /**
     * __filter
     *
     * @param $data, $journal
     */
    private function __filter($data, $journal){
        if (empty($journal)) {
            return false;
        }
        $data['Article']['publisher_source'] = __d('filter_local', 'Local');
        if (empty($data['Article']['publisher_policy'])) {
            $data['Article']['publisher_policy'] = $journal['Journal']['publisher_policy'];
        }
        if (empty($data['Article']['publisher_open_condition'])) {
            $data['Article']['publisher_open_condition'] = $journal['Journal']['publisher_open_condition'];
        }
        if (empty($data['Article']['publisher_open_file_version'])) {
            $data['Article']['publisher_open_file_version'] = $journal['Journal']['publisher_open_file_version'];
        }
        if (empty($data['Article']['publisher_request_method'])) {
            $data['Article']['publisher_request_method'] = $journal['Journal']['publisher_request_method'];
        }
        if (empty($data['Article']['publisher_contact_info'])) {
            $info = __('Publisher Contact Email') . ':' . $journal['Journal']['publisher_contact_email'] . "\n";
            $info .= __('Publisher Contact Address') . ':' . $journal['Journal']['publisher_contact_zipcode'] . ' ' . $journal['Journal']['publisher_contact_address'] . "\n";
            $info .= __('Publisher Contact Tel No') . ':' . $journal['Journal']['publisher_contact_tel_no'] . "\n";
            $info .= __('Publisher Contact Fax No') . ':' . $journal['Journal']['publisher_contact_fax_no'];
            $data['Article']['publisher_contact_info'] = $info;
        }
        if (empty($data['Article']['publisher_remarks'])) {
            $data['Article']['publisher_remarks'] = $journal['Journal']['publisher_remarks'];
        }
        if (empty($data['Article']['publisher_policy_uri'])) {
            $data['Article']['publisher_policy_uri'] = $journal['Journal']['publisher_policy_uri'];
        }
        return $data;
    }
}

