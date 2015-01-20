<?php

class Request {

    /**
     * Request data
     * 
     * @var array
     */
    protected $_aRequestData = null;

    /**
     * singleton instance of Request
     * 
     * @var Request
     */
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

    /**
     * Return Request instance
     * 
     * @return Request
     */
    public static function getInstance() {
        if (is_null(self::$_oInstance)) {
            self::$_oInstance = new self;
        }

        return self::$_oInstance;
    }

    /**
     * validate session token
     * 
     * @return null
     * @throws Exception
     */
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

    /**
     * check if the request method is POST
     * 
     * @return bool
     */
    public static function isPost() {
        return ($_SERVER['REQUEST_METHOD'] == 'POST');
    }

    /**
     * check if the request method is GET
     * 
     * @return bool
     */
    public static function isGet() {
        return ($_SERVER['REQUEST_METHOD'] == 'GET');
    }

    /**
     * check if the is AJAX request
     * 
     * @return bool
     */
    public static function isAjax() {
        return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
    }

    /**
     * request param getter
     * 
     * @param string $sParamName request data key
     * @param mixed $mDefValue request param
     * @return mixed
     */
    public function getRequestParam($sParamName, $mDefValue = null) {
        return (isset($this->_aRequestData[$sParamName]) ? $this->_aRequestData[$sParamName] : $mDefValue);
    }

    /**
     * request param setter
     * 
     * @param string $sParamName request data key
     * @param mixed $mParamValue request value
     * @return mixed
     */
    public function setRequestParam($sParamName, $mParamValue) {
        $this->_aRequestData[$sParamName] = $mParamValue;
    }

    /**
     * return all request array
     * 
     * @return array
     */
    public function getRequest() {
        return $this->_aRequestData;
    }

    /**
     * create new session token
     * 
     * @return null
     */
    protected function _setNewToken() {
        Session::getInstance()->set('new_sess_token', uniqid('sess_'));
    }

    /**
     * cookie getter
     * 
     * @static
     * @param string $sCookieName cookie name
     * @param mixed $mDefValue default value if cookie not set
     * @return mixed
     */
    public static function getCookie($sCookieName, $mDefValue = null) {
        return (isset($_COOKIE[$sCookieName]) ? $_COOKIE[$sCookieName] : $mDefValue);
    }

    /**
     * cookie setter
     * 
     * @static
     * @param string $sCookieName cookie name
     * @param mixed $mCookieValue cookie value
     * @param int $iExpire expiration time
     * @return null
     */
    public static function setCookie($sCookieName, $mCookieValue, $iExpire) {
        setcookie($sCookieName, $mCookieValue, $iExpire);
    }

    /**
     * drop cookie
     * 
     * @static
     * @param string $sCookieName cookie name
     * @return null
     */
    public static function dropCookie($sCookieName) {
        unset($_COOKIE[$sCookieName]);
    }

}
