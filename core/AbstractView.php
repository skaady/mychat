<?php

abstract class AbstractView {

    protected $_sTplName = '';
    protected $_aJs = [];
    protected $_aCss = [];
    protected $_aRawJs = [];
    protected $_oConf = null;

    public function __construct(Conf $oConf) {
        $this->_oConf = $oConf;
    }

    public function setViewData(array $aViewData) {
        foreach ($aViewData as $sKey => $myData) {
            $this->{$sKey} = $myData;
        }
    }

    abstract public function fetchTpl();

    protected function _processTpl() {
        $sResult = '';
        if (file_exists($this->_sTplName)) {
            ob_start();
            require_once $this->_sTplName;
            $sResult = ob_get_clean();
        }

        return $sResult;
    }

    protected function _addJs($sSrc, $iPriority = 10, $blExternal = false) {
        $this->_aJs[$iPriority][md5($sSrc)] = ($blExternal ? $sSrc : $this->_oConf->getConfParam('sSrcRoot') . 'js/' . $sSrc);
    }

    protected function _addStyles($sSrc, $blExternal = false) {
        $this->_aCss[] = ($blExternal ? $sSrc : $this->_oConf->getConfParam('sSrcRoot') . 'css/' . $sSrc);
    }

    protected function _writeJs($sScript, $iPriority = 20, $aOptions = array()) {
        $this->_aRawJs[$iPriority][md5($sScript)] = '<script type="text/javascript" ' . implode(' ', $aOptions) . '>' . $sScript . '</script>';
    }

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

    public function getCssSnippet() {
        $sResult = '';

        foreach ($this->_aCss as $sSrc) {
            $sResult .= '<link rel="stylesheet" type="text/css" href="' . $sSrc . '" />' . PHP_EOL;
        }

        return $sResult;
    }

    protected function _includeTpl($sTplPath) {
        include($this->_oConf->getConfParam('sTplRoot') . $sTplPath);
    }

    public static function getImgPath() {
        return $this->_oConf->getConfParam('sImgRoot');
    }

}
