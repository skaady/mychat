<?php

class Session {

    protected static $_oInstance = null;
    protected $_aSessionVars = [];

    public static function getInstance() {
        if (is_null(self::$_oInstance)) {
            self::$_oInstance = new self;
        }

        return self::$_oInstance;
    }

    private function __construct() {
        session_start();

        foreach ($_SESSION as $sKey => $mValue) {
            $this->_aSessionVars[$sKey] = $mValue;
        }
    }

    private function __clone() {
        ;
    }

    private function __sleep() {
        ;
    }

    private function __wakeup() {
        ;
    }

    public function __destruct() {
        foreach ($this->getAll() as $sKey => $mValue) {
            $_SESSION[$sKey] = $mValue;
        }
        
        session_commit();
    }

    public function get($sParamName, $mDefValue = null) {
        return (isset($this->_aSessionVars[$sParamName]) ? $this->_aSessionVars[$sParamName] : $mDefValue);
    }

    public function set($sParamName, $mValue) {
        $this->_aSessionVars[$sParamName] = $mValue;
    }

    public function drop($sParamName) {
        unset($this->_aSessionVars[$sParamName]);
    }

    public function getAll() {
        return $this->_aSessionVars;
    }

}
