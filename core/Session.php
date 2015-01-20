<?php

class Session {

    /**
     * Singleton instance of Session
     * 
     * @static
     * @var Session
     */
    protected static $_oInstance = null;
    
    /**
     * sessions var array
     * 
     * @var array
     */
    protected $_aSessionVars = [];

    /**
     * return singleton instance
     * 
     * @static
     * @return Session
     */
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

    /**
     * session values getter
     * 
     * @param string $sParamName session param name
     * @param mixed $mDefValue Default value if requested param is not set
     * @return mixed
     */
    public function get($sParamName, $mDefValue = null) {
        return (isset($this->_aSessionVars[$sParamName]) ? $this->_aSessionVars[$sParamName] : $mDefValue);
    }

    /**
     * session values setter
     * 
     * @param string $sParamName session param name
     * @param mixed $mValue session param
     * @return null
     */
    public function set($sParamName, $mValue) {
        $this->_aSessionVars[$sParamName] = $mValue;
    }

    /**
     * remove data from session
     * 
     * @param string $sParamName session param name
     * @return null
     */
    public function drop($sParamName) {
        unset($this->_aSessionVars[$sParamName]);
    }

    /**
     * return all session data
     * 
     * @return array
     */
    public function getAll() {
        return $this->_aSessionVars;
    }

}
