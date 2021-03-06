<?php
App::uses('CakeLogInterface', 'Log');
App::uses('FileLog', 'Log/Engine');

/**
 * File Storage stream for Logging with log rotate
 *
 */
if (!class_exists('File')) {
    App::uses('File', 'Utility');
}

class RotateFileLog extends FileLog {

    protected $_path = null;
    protected $_prefix = 'error';
    protected $_suffix = '';
    protected $_rotate = null;

    /**
     * Implements writing to log files.
     *
     * @param string $type The type of log you are making.
     * @param string $message The message you want to log.
     * @return boolean success of write.
     */
    public function write($type, $message) {
        $debugTypes = array('notice', 'info', 'debug');
        $this->_suffix = date('Ymd');
        if (Configure::read('Yalog.RotateFileLog.monthly') == true) {
            $this->_suffix = date('Ym');
        }
        if (Configure::read('Yalog.RotateFileLog.weekly') == true) {
            if (date('w') == 0) {
                $this->_suffix = date('Ymd') . 'w';
            } else {
                $this->_suffix = date('Ymd', strtotime('-' . date('w') . ' day')) . 'w';
            }
        }

        // @see FileLog::write()
        if (!empty($this->_file)) {
            $filename = $this->_file;
        } elseif ($type == 'error' || $type == 'warning') {
            $filename = 'error.log';
        } elseif (in_array($type, $debugTypes)) {
            $filename = 'debug.log';
        } elseif (isset($this->_config) && in_array($type, $this->_config['scopes'])) { // 2.1.x compatible
            $filename = $this->_file;
        } else {
            $filename = $type . '.log';
        }

        $this->_prefix = preg_replace('/\.([^\.]+)$/', '', $filename);
        $extension = end(explode('.', $filename));

        $filename = $this->_path . $this->_prefix . '_' . $this->_suffix . (!empty($extension) ? '.' . $extension : '');
        $output = date('Y-m-d H:i:s') . ' ' . ucfirst($type) . ': ' . $message . "\n";
        $log = new File($filename, true);
        // Write Log
        if (!$log->writable()) {
            return false;
        }
        if (!$log->append($output)) {
            return false;
        }
        // Rotate log
        if (Configure::read('Yalog.RotateFileLog.rotate')) {
            $this->_rotate = Configure::read('Yalog.RotateFileLog.rotate');
            $logs = glob($this->_path . $this->_prefix . '_*'. (!empty($extension) ? '.' . $extension : ''));
            while(count($logs) > $this->_rotate) {
                if (!$this->_removeLog($logs[0])) {
                    return false;
                }
                array_shift($logs);
            }
        }
        return true;
    }

    /**
     * _removeLog
     *
     * @param $filePath
     */
    private function _removeLog($filePath){
        $deleteLog = new File($filePath, true);
        return $deleteLog->delete();
    }
}
