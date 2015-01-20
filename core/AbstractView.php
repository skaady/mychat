<?php

abstract class AbstractView {

    /**
     * Template name for processing
     * 
     * @var string
     */
    protected $_sTplName = '';

    /**
     * list of included js
     * 
     * @var array
     */
    protected $_aJs = [];

    /**
     * list of included css
     * 
     * @var array
     */
    protected $_aCss = [];

    /**
     * list of included raw-js
     * 
     * @var array
     */
    protected $_aRawJs = [];

    /**
     * Cpnf object
     * 
     * @var Conf
     */
    protected $_oConf = null;

    public function __construct(Conf $oConf) {
        $this->_oConf = $oConf;
    }

    /**
     * Set view data for processing
     * 
     * @param array $aViewData
     * @return null
     */
    public function setViewData(array $aViewData) {
        foreach ($aViewData as $sKey => $myData) {
            $this->{$sKey} = $myData;
        }
    }

    abstract public function fetchTpl();

    /**
     * process template with view data
     * 
     * @return string
     */
    protected function _processTpl() {
        $sResult = '';
        if (file_exists($this->_sTplName)) {
            ob_start();
            require_once $this->_sTplName;
            $sResult = ob_get_clean();
        }

        return $sResult;
    }

    /**
     * add js src to js list
     * 
     * @param string $sSrc js source link
     * @param int $iPriority include order
     * @param bool $blExternal internal/external source link
     * @return null
     */
    protected function _addJs($sSrc, $iPriority = 10, $blExternal = false) {
        $this->_aJs[$iPriority][md5($sSrc)] = ($blExternal ? $sSrc : $this->_oConf->getConfParam('sSrcRoot') . 'js/' . $sSrc);
    }

    /**
     * add css src to css list
     * 
     * @param string $sSrc css source link
     * @param bool $blExternal internal/external source link
     * @return null
     */
    protected function _addStyles($sSrc, $blExternal = false) {
        $this->_aCss[] = ($blExternal ? $sSrc : $this->_oConf->getConfParam('sSrcRoot') . 'css/' . $sSrc);
    }

    /**
     * add raw-js to js list
     * 
     * @param string $sScript raw-js text
     * @param int $iPriority include order
     * @param array $aOptions async/defer
     * @return null
     */
    protected function _writeJs($sScript, $iPriority = 20, $aOptions = array()) {
        $this->_aRawJs[$iPriority][md5($sScript)] = '<script type="text/javascript" ' . implode(' ', $aOptions) . '>' . $sScript . '</script>';
    }

    /**
     * add all js to page
     * 
     * @return string
     */
    public function getJsSnippet() {
        $sResult = '';
        ksort($this->_aJs);

        foreach ($this->_aJs as $aPriorGroup) {
            foreach ($aPriorGroup as $sSrc) {
                $sResult .= '<script type="text/javascript" src="' . $sSrc . '"></script>' . PHP_EOL;
            }
        }

        ksort($this->_aRawJs);

        foreach ($this->_aRawJs as $aPriorGroup) {
            foreach ($aPriorGroup as $sScript) {
                $sResult .= $sScript;
            }
        }

        return $sResult;
    }

    /**
     * add all css to page
     * 
     * @return string
     */
    public function getCssSnippet() {
        $sResult = '';

        foreach ($this->_aCss as $sSrc) {
            $sResult .= '<link rel="stylesheet" type="text/css" href="' . $sSrc . '" />' . PHP_EOL;
        }

        return $sResult;
    }

    /**
     * include another tpl to current page
     * 
     * @param string $sTplPath
     * @return null
     */
    protected function _includeTpl($sTplPath) {
        include($this->_oConf->getConfParam('sTplRoot') . $sTplPath);
    }
}
