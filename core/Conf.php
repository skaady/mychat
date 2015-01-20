<?php

class Conf {

    protected $_aConfData = [];
    protected static $_oInstanse = null;

    private function __construct() {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/config.inc.php';
        $this->_aConfData = $aConfData;
    }

    private function __sleep() {
        ;
    }

    private function __clone() {
        ;
    }

    private function __wakeup() {
        ;
    }

    public static function getInstance() {
        if (is_null(self::$_oInstanse)) {
            self::$_oInstanse = new self;
        }

        return self::$_oInstanse;
    }

    public function getConfParam($sParamName, $mDefValue = null) {
        return (isset($this->_aConfData[$sParamName]) ? $this->_aConfData[$sParamName] : $mDefValue);
    }

    public function setConfParam($sParamName, $mParam) {
        if ($sParamName) {
            $this->_aConfData[$sParamName] = $mParam;
        }
    }

}
