<?php
App::uses('AppController', 'Controller');
App::uses('RoutineController', 'Routine.Controller');

class JournalsController extends RoutineController {

    public $components = array('Search.Prg');

    public $presetVars = array(
        array('field' => 'keyword', 'type' => 'value', 'encode' => true),
        array('field' => 'publisher_policy', 'type' => 'value'),
    );

    /**
     * index
     *
     */
    public function index(){
        $this->_search();
    }

    /**
     * import
     *
     */
    public function import(){
        $this->Journal->importFilterArgs = array(
            array('name' => 'csv')
        );

        try {
            // ヘッダ情報からimportFieldsを作成
            if (!empty($this->request->data['Journal']['csv']['tmp_name'])) {
                $options = array(
                    'csvEncoding' => 'auto',
                    'hasHeader' => false,
                    'delimiter' => 'auto',
                    'enclosure' => 'auto',
                    'allowExtension' => array('csv', 'txt', 'tsv', 'CSV', 'TXT', 'TSV'),
                    'parseLimit' => 5,
                );
                $this->Journal->setCsvOptions($options);
                $tmpFilePath = $this->request->data['Journal']['csv']['tmp_name'];
                $parsedData = $this->Journal->parseCsvFile($tmpFilePath);
                $options = $this->Journal->getCsvOptions();
                $this->Journal->importFields = $parsedData[0]['data'];

                if (in_array($this->Journal->primaryKey, array_values($this->Journal->importFields))
                    || in_array('delete_flg', array_values($this->Journal->importFields))
                    || in_array('deleted', array_values($this->Journal->importFields))
                ) {
                    throw new InternalErrorException(__('Invalid header'));
                }

                // ヘッダを抜かして文字コードを取得
                $options = array(
                    'csvEncoding' => 'auto',
                    'hasHeader' => true,
                    'delimiter' => 'auto',
                    'enclosure' => 'auto',
                    'allowExtension' => array('csv', 'txt', 'tsv', 'CSV', 'TXT', 'TSV'),
                    'parseLimit' => 5,
                );
                $this->Journal->setCsvOptions($options);
                $this->Journal->parseCsvFile($tmpFilePath);
                $options = $this->Journal->getCsvOptions();
            }

            $encoding = empty($options['csvEncoding']) ? 'SJIS-win' : $options['csvEncoding'];
            $options = array(
                'csvEncoding' => $encoding,
                'hasHeader' => 1,
                'delimiter' => 'auto',
                'enclosure' => 'auto',
                'saveMethod' => array($this->Journal, 'add'),
                'forceImport' => true, // 問題のない行はsaveする
                'allowExtension' => array('csv', 'txt', 'tsv', 'CSV', 'TXT', 'TSV'),
                'parseLimit' => false,
            );
            $result = $this->Journal->importCsv($this->request->data, $options);
            if ($result === true) {
                $this->Session->setFlash(__('The Journals has been imported'), 'alert', array(
                        'plugin' => 'TwitterBootstrap',
                        'class' => 'alert-success'
                    ));
                if (empty($this->Journal->importValidationErrors)) {
                    $this->redirect(array('action' => 'index'));
                }
                $this->set(array(
                        'count' => $this->Journal->getImportedCount(),
                        'result' => $this->Journal->importValidationErrors
                    ));
            }
        } catch (Exception $e) {
            $this->Session->setFlash($e->getMessage(), 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));
        }
    }

    /**
     * export
     *
     */
    public function export(){
        $this->layout = false;
        $this->autoRender = false;
        $journals = $this->Journal->find('all');
        $schema = $this->Journal->schema();
        unset($schema['delete_flg']);
        unset($schema['deleted']);
        header("Cache-Control: public");
        header("Pragma: public");
        header("Content-Type: text/octet-stream");
        header("Content-Disposition: attachment; filename=journals.csv");
        foreach ($schema as $fieldName => $value) {
            if ($fieldName === 'title') {
                $header[$fieldName] = __('Journal Title');
            } else {
                $header[$fieldName] = __(Inflector::humanize($fieldName));
            }
        }
        unset($header['delete_flg']);
        unset($header['deleted']);

        // メモリ制限なし
        ini_set('memory_limit', -1);
        // タイムアウト制限なし
        ini_set('max_execution_time', 0);
        $policy_colors = Configure::read('Article.policy_colors');
        $request_methods = Configure::read('Article.request_methods');
        $publisher_open_file_versions = Configure::read('Article.publisher_open_file_versions');
        $line = '"' . implode('","', array_values($header)) . '"' . "\r\n";
        echo mb_convert_encoding($line, 'SJIS-win', 'UTF-8');

        foreach ($journals as $journal) {
            $lineArray = array();
            foreach ($header as $key => $value) {
                switch($key) {
                    case 'publisher_policy':
                        $lineArray[] = empty($policy_colors[$journal['Journal']['publisher_policy']]) ? '' : $policy_colors[$journal['Journal']['publisher_policy']];
                        continue 2;
                        break;
                    case 'publisher_request_method':
                        $lineArray[] = empty($request_methods[$journal['Journal']['publisher_request_method']]) ? '' : $request_methods[$journal['Journal']['publisher_request_method']];
                        continue 2;
                        break;
                    case 'publisher_open_file_version':
                        $lineArray[] = empty($publisher_open_file_versions[$journal['Journal']['publisher_open_file_version']]) ? '' : $publisher_open_file_versions[$journal['Journal']['publisher_open_file_version']];
                        continue 2;
                        break;
                }
                if (!array_key_exists($key, $journal['Journal'])) {
                    die_a($journal); // for debug
                }
                $lineArray[] = str_replace('"', '""', $journal['Journal'][$key]);
            }
            $line = '"' . implode('","', $lineArray) . '"' . "\r\n";
            echo mb_convert_encoding($line, 'SJIS-win', 'UTF-8');
        }
    }

    /**
     * beforeRender
     *
     */
    public function beforeRender(){
        parent::beforeRender();

        $allowSchema = $this->Journal->schema();
        unset($allowSchema['id']);
        unset($allowSchema['created']);
        unset($allowSchema['modified']);
        unset($allowSchema['delete_flg']);
        unset($allowSchema['deleted']);
        $allowSchema = array_keys($allowSchema);

        $request_methods = Configure::read('Article.request_methods');
        $this->set(array(
                'publisher_request_methods' => $request_methods,
                'schema' => $allowSchema,
            ));
    }
}