<?php

class Conf {

    /**
     * Configuration data
     * 
     * @var array
     */
    protected $_aConfData = [];
    
    /**
     * singleton instance
     * 
     * @var Conf
     */
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

    /**
     * return instance of Conf class
     * 
     * @static
     * @return Conf
     */
    public static function getInstance() {
        if (is_null(self::$_oInstanse)) {
            self::$_oInstanse = new self;
        }

        return self::$_oInstanse;
    }

    /**
     * configuration param getter
     * 
     * @param string $sParamName conf key
     * @param mixed $mDefValue default value if conf key not set
     * @return mixed
     */
    public function getConfParam($sParamName, $mDefValue = null) {
        return (isset($this->_aConfData[$sParamName]) ? $this->_aConfData[$sParamName] : $mDefValue);
    }

    /**
     * configuration param setter
     * 
     * @param string $sParamName conf key
     * @param mixed $mParam conf value
     * @return null
     */
    public function setConfParam($sParamName, $mParam) {
        if ($sParamName) {
            $this->_aConfData[$sParamName] = $mParam;
        }
    }

}
