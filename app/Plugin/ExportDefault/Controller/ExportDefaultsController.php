<?php

class ExportDefaultsController extends ExportDefaultAppController {

    public $uses = array(
        'Article',
        'AuthorStatus',
        'PublisherStatus',
        'CoauthorStatus',
    );

    /**
     * beforeFilter
     *
     */
    public function beforeFilter(){
        parent::beforeFilter();
        if ($this->Security) {
            $this->Security->csrfCheck = false;
        }
    }

    /**
     * export
     *
     */
    public function export(){
        $this->layout = false;
        $this->autoRender = false;
        $data = $this->request->data;
        $this->Article->hasAll();
        $conditions = $this->Article->parseCriteria($data['Article']);
        if (
            empty($conditions['Article.author_status_id'])
            && empty($conditions['Article.publisher_status_id'])
            && empty($conditions['Article.coauthor_status_id'])
        ) {
            // デフォルトの条件設定
            $authorOpenStatus = $this->AuthorStatus->findStatuses('list', STATUS_TYPE_OPEN);
            $publisherOpenStatus = $this->PublisherStatus->findStatuses('list', STATUS_TYPE_OPEN);
            $coauthorOpenStatus = $this->CoauthorStatus->findStatuses('list', STATUS_TYPE_OPEN);
            $conditions[] = array('OR' => array(
                    'Article.author_status_id' => array_keys($authorOpenStatus),
                    'Article.publisher_status_id' => array_keys($publisherOpenStatus),
                    'Article.coauthor_status_id' => array_keys($coauthorOpenStatus),
                ));
        }
        $articles = $this->Article->find('all', array('conditions' => $conditions));
        $schema = $this->Article->schema();
        header("Cache-Control: public");
        header("Pragma: public");
        header("Content-Type: text/octet-stream");
        header("Content-Disposition: attachment; filename=articles.csv");
        $header = array();
        foreach ($schema as $fieldName => $value) {
            if (preg_match('/^coauthor_.+([1-5])$/', $fieldName, $matches)) {
                $header[$fieldName] = __(preg_replace('/[1-5]$/', '', Inflector::humanize($fieldName)) . ' %s', $matches[1]);
            } else {
                $header[$fieldName] = __(Inflector::humanize($fieldName));
            }
        }
        unset($header['hash']);
        $header['file_count'] = __('File Status');
        unset($header['delete_flg']);
        unset($header['deleted']);

        // メモリ制限なし
        ini_set('memory_limit', -1);
        // タイムアウト制限なし
        ini_set('max_execution_time', 0);

        // header
        $policy_colors = Configure::read('Article.policy_colors');
        $request_methods = Configure::read('Article.request_methods');
        $this->AuthorStatus->disableSoftDeletable();
        $author_statuses = $this->AuthorStatus->find('list');
        $this->PublisherStatus->disableSoftDeletable();
        $publisher_statuses = $this->PublisherStatus->find('list');
        $this->CoauthorStatus->disableSoftDeletable();
        $coauthor_statuses = $this->CoauthorStatus->find('list');
        $publisher_open_file_versions = Configure::read('Article.publisher_open_file_versions');
        $line = '"' . implode('","', array_values($header)) . '"' . "\r\n";
        echo mb_convert_encoding($line, 'SJIS-win', 'UTF-8');
        foreach ($articles as $article) {
            $lineArray = array();
            foreach ($header as $key => $value) {
                switch($key) {
                    case 'publisher_policy':
                        $lineArray[] = empty($article['Article']['publisher_policy']) ? '' : $policy_colors[$article['Article']['publisher_policy']];
                        continue 2;
                        break;
                    case 'publisher_request_method':
                        $lineArray[] = empty($article['Article']['publisher_request_method']) ? '' : $request_methods[$article['Article']['publisher_request_method']];
                        continue 2;
                        break;
                    case 'publisher_open_file_version':
                        $lineArray[] = empty($article['Article']['publisher_open_file_version']) ? '' : $publisher_open_file_versions[$article['Article']['publisher_open_file_version']];
                        continue 2;
                        break;
                    case 'author_request_method':
                        $lineArray[] = empty($article['Article']['author_request_method']) ? '' : $request_methods[$article['Article']['author_request_method']];
                        continue 2;
                        break;
                    case 'author_coauthor_flg':
                        $lineArray[] = empty($article['Article']['author_coauthor_flg']) ? __('Coauthor Flg Disable') : __('Coauthor Flg Enable');
                        continue 2;
                        break;
                    case 'author_status_id':
                        $lineArray[] = $author_statuses[$article['Article']['author_status_id']];
                        continue 2;
                        break;
                    case 'publisher_status_id':
                        $lineArray[] = $publisher_statuses[$article['Article']['publisher_status_id']];
                        continue 2;
                        break;
                    case 'coauthor_status_id':
                        $lineArray[] = $coauthor_statuses[$article['Article']['coauthor_status_id']];
                        continue 2;
                        break;
                    case 'file_count':
                        if ($article['Article']['file_count'] > 0) {
                            $lineArray[] = __('Uploaded');
                        } else {
                            $lineArray[] = __('No File');
                        }
                        continue 2;
                        break;
                }
                if (!array_key_exists($key, $article['Article'])) {
                    die_a($article); // for debug
                }
                $lineArray[] = str_replace('"', '""', $article['Article'][$key]);
            }
            $line = '"' . implode('","', $lineArray) . '"' . "\r\n";
            echo mb_convert_encoding($line, 'SJIS-win', 'UTF-8');
        }
    }

}

