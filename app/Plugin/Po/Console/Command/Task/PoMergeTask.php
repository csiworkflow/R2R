<?php

App::uses('AppShell', 'Console/Command');

class PoMergeTask extends Shell{

    public $created = null;
    public $current = null;

    public function execute() {

        if (isset($this->params['root'])) {
            $root = $this->params['root'];
        } else {
            $root = ROOT;
        }

        if (isset($this->params['created'])) {
            $this->created = $this->params['created'];
        } else {
            $response = '';
            $default = ((defined('PO_CREATED')) ? PO_CREATED : $root . DS . "app" . DS . "Locale" . DS . "default.pot");
            $example = ($default) ? $default : 'Q';
            while ($response == '') {
                $response = $this->in("What is the full path you would like to merge file (created pot file)?\nExample: "
                                      . $default
                                      . "\n[Q]uit", null, $example);
                if (strtoupper($response) === 'Q') {
                    $this->out('Merge Aborted');
                    $this->_stop();
                }
            }

            if (is_file($response)) {
                $this->created = $response;
            } else {
                $this->err('The file path you supplied was not found. Please try again.');
                $this->execute();
            }
        }

        if (isset($this->params['debug'])) {
            $this->path = ROOT;
            $this->files = array(__FILE__);
        }

        if (isset($this->params['current'])) {
            $this->current = $this->params['current'];
        } else {
            $response = '';
            $default = ((defined('PO_CURRENT')) ? PO_CURRENT : $root . DS . "app" . DS . "Locale" . DS . "jpn" . DS . "LC_MESSAGES" . DS . "default.po");
            $example = ($default) ? $default : 'Q';
            while ($response == '') {
                $response = $this->in("What is the full path you would like to merge file (current po file)?\nExample: "
                                      . $default
                                      . "\n[Q]uit", null, $example);
                if (strtoupper($response) === 'Q') {
                    $this->out('Merge Aborted');
                    $this->_stop();
                }
            }

            if (is_file($response)) {
                $this->current = $response;
            } else {
                $this->err('The file path you supplied was not found. Please try again.');
                $this->execute();
            }
        }

        $this->__merge();
    }

    /**
     * __merge
     * merge
     *
     * @return
     */
    public function __merge(){

        /**
         * created file.
         *
         */
        $fp = fopen($this->created,"r");

        $from = array();

        $header = '';

        $current_comment = '';
        $msgid = '';

        $this->out(sprintf(__('Processing %s...', true), $this->created));
        if($fp){
            while(!feof($fp)) {
                $line = preg_replace('/\n/', '', fgets($fp));
                if (preg_match('/^(#:.*)$/',$line,$matches)) {
                    //file comments
                    $current_comment .= $matches[1] . "\n";
                } elseif (preg_match('/^msgid "(.*)"$/',$line,$matches)) {
                    //msgid
                    $msgid = $matches[1];
                    $from[$msgid]['msgid'] = $msgid;
                } elseif (preg_match('/^msgstr "(.*)"$/',$line,$matches)) {
                    //msgstr
                    $from[$msgid]['msgstr'] = $matches[1];
                    $from[$msgid]['comments'] = $current_comment;
                    $current_comment = '';
                } elseif (preg_match('/^(".+)$/',$line,$matches)) {
                    //header
                    $header .= $matches[1] . "\n";
                }
            }
            fclose($fp);
        }

        /**
         * current file.
         *
         */
        $fp = fopen($this->current,"r");

        $into = array();

        $current_comment = '';
        $msgid = '';

        $this->out(sprintf(__('Processing %s...', true), $this->current));
        if($fp){
            while(!feof($fp)) {
                $line = preg_replace('/\n/', '', fgets($fp));
                if (preg_match('/^(#:.*)$/',$line,$matches)) {
                    //file comments
                    //$current_comment .= $matches[1] . "\n";
                } elseif (preg_match('/^msgid "(.*)"$/',$line,$matches)) {
                    //msgid
                    $msgid = $matches[1];
                    $into[$msgid]['msgid'] = $msgid;
                } elseif (preg_match('/^msgstr "(.*)"$/',$line,$matches)) {
                    //msgstr
                    $into[$msgid]['msgstr'] = $matches[1];
                    $into[$msgid]['comments'] = $current_comment;
                    $current_comment = '';
                } elseif (preg_match('/^(".+)$/',$line,$matches)) {
                    //header
                    //$header .= $matches[1] . "\n";
                }
            }
            fclose($fp);
        }

        $this->out(__('Merging ...', true));
        $merged = array_merge($from,$into);

        foreach ($merged as $key => $value) {
            if (isset($from[$key]['comments'])) {
                $merged[$key]['comments'] = $from[$key]['comments'];
            }
        }

        $out = '';
        $header_comment = '# LANGUAGE translation of CakePHP Application
# Copyright YEAR NAME <EMAIL@ADDRESS>
#
#, fuzzy
msgid ""
msgstr ""' . "\n";

        $out .= $header_comment;
        $out .= $header;
        foreach ($merged as $key => $value) {
            if (!empty($value['msgid'])) {
                $out .= "\n";
                $out .= $value['comments'];
                $out .= 'msgid "' . $value['msgid'] . "\"\n";
                $out .= 'msgstr "'. $value['msgstr'] . "\"\n";
            }
        }
        $this->createFile($this->current, $out);

        $this->out('Done.');
    }

}

function cmp($a, $b) {
    if ($a['msgid'] == $b['msgid']) {
        return 0;
    }
    return ($a['msgid'] < $b['msgid']) ? -1 : 1;
}