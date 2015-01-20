<?php

class Request {

    protected $_aRequestData = null;
    protected static $_oInstance = null;

    private function __construct() {
        $this->_aRequestData = $_REQUEST;

        $this->_setNewToken();

        $this->_checkToken();
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

    public static function getInstance() {
        if (is_null(self::$_oInstance)) {
            self::$_oInstance = new self;
        }

        return self::$_oInstance;
    }

    protected function _checkToken() {
        if (self::isPost()) {
            $sToken = $this->getRequestParam('token');
            $oSess = Session::getInstance();

            if ($sToken != $oSess->get('sess_token')) {
                $oSess->drop('user_id');

                throw new Exception('Wrong token');
            }
        }
    }

    public static function isPost() {
        return ($_SERVER['REQUEST_METHOD'] == 'POST');
    }

    public static function isGet() {
        return ($_SERVER['REQUEST_METHOD'] == 'GET');
    }

    public static function isAjax() {
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    }

    public function getRequestParam($sParamName, $mDefValue = null) {
        return (isset($this->_aRequestData[$sParamName]) ? $this->_aRequestData[$sParamName] : $mDefValue);
    }

    public function setRequestParam($sParamName, $mParamValue) {
        $this->_aRequestData[$sParamName] = $mParamValue;
    }

    public function getRequest() {
        return $this->_aRequestData;
    }

    protected function _setNewToken() {
        Session::getInstance()->set('new_sess_token', uniqid('sess_'));
    }

    public static function getCookie($sCookieName, $mDefValue = null) {
        return (isset($_COOKIE[$sCookieName]) ? $_COOKIE[$sCookieName] : $mDefValue);
    }

    public static function setCookie($sCookieName, $mCookieValue, $iExpire) {
        setcookie($sCookieName, $mCookieValue, $iExpire);
    }

    public static function dropCookie($sCookieName) {
        unset($_COOKIE[$sCookieName]);
    }

}
