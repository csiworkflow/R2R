<?php

class ImportDefaultsController extends ImportDefaultAppController {

    public $uses = array('Article');

    /**
     * import
     *
     */
    public function import(){
        $this->Article->importFilterArgs = array(
            array('name' => 'csv')
        );

        try {
            // メモリ制限なし
            ini_set('memory_limit', -1);
            // タイムアウト制限なし
            ini_set('max_execution_time', 0);

            // ヘッダ情報からimportFieldsを作成
            if (!empty($this->request->data['Article']['csv']['tmp_name'])) {
                $options = array(
                    'csvEncoding' => 'auto',
                    'hasHeader' => false,
                    'delimiter' => 'auto',
                    'enclosure' => 'auto',
                    'allowExtension' => array('csv', 'txt', 'tsv', 'CSV', 'TXT', 'TSV'),
                    'parseLimit' => 5,
                );
                $this->Article->setCsvOptions($options);
                $tmpFilePath = $this->request->data['Article']['csv']['tmp_name'];
                $parsedData = $this->Article->parseCsvFile($tmpFilePath);
                $options = $this->Article->getCsvOptions();
                $this->Article->importFields = $parsedData[0]['data'];
                $fields = array_values($this->Article->importFields);
                foreach ($fields as $field) {
                    if (in_array($field, array(
                                $this->Article->primaryKey,
                                'hash',
                                'file_count',
                                'delete_flg',
                                'deleted',
                                'created',
                                'modified',
                            ))) {
                        throw new InternalErrorException(__('Invalid header'));
                    }
                    if (preg_match('/flg$/', $field)
                        || preg_match('/^coauthor/', $field)
                        || preg_match('/status_id$/', $field)) {
                        throw new InternalErrorException(__('Invalid header'));
                    }
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
                $this->Article->setCsvOptions($options);
                $this->Article->parseCsvFile($tmpFilePath);
                $options = $this->Article->getCsvOptions();
            }
            $encoding = empty($options['csvEncoding']) ? 'SJIS-win' : $options['csvEncoding'];
            $options = array(
                'csvEncoding' => $encoding,
                'hasHeader' => 1,
                'delimiter' => 'auto',
                'enclosure' => 'auto',
                'saveMethod' => array($this->Article, 'add'),
                'forceImport' => true, // 問題のない行はsaveする
                'allowExtension' => array('csv', 'txt', 'tsv', 'CSV', 'TXT', 'TSV'),
                'parseLimit' => false,
            );
            $result = $this->Article->importCsv($this->request->data, $options);
            if ($result === true) {
                $this->Session->setFlash(__('The articles has been imported'), 'alert', array(
                        'plugin' => 'TwitterBootstrap',
                        'class' => 'alert-success'
                    ));
                if (empty($this->Article->importValidationErrors)) {
                    $this->redirect(array('controller' => 'articles', 'action' => 'index', 'plugin' => false));
                }
                $this->set(array(
                        'count' => $this->Article->getImportedCount(),
                        'result' => $this->Article->importValidationErrors
                    ));
            }
        } catch (Exception $e) {
            $this->Session->setFlash($e->getMessage(), 'alert', array(
                    'plugin' => 'TwitterBootstrap',
                    'class' => 'alert-error'
                ));
        }

        $schema = $this->Article->schema();
        unset($schema['id']);
        unset($schema['hash']);
        unset($schema['file_count']);
        unset($schema['deleted']);
        unset($schema['delete_flg']);
        unset($schema['created']);
        unset($schema['modified']);
        foreach ($schema as $field => $value) {
            if (preg_match('/flg$/', $field)
                || preg_match('/^coauthor/', $field)
                || preg_match('/status_id$/', $field)) {
                unset($schema[$field]);
            }
        }

        $this->set('schema', array_keys($schema));
    }
}

