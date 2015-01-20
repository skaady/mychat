<?php

abstract class AbstractController {

    protected $_sViewName = null;
    protected $_aViewData = [];
    protected $_oConf = null;

    public function __construct(Conf $oConf) {
        $this->_oConf = $oConf;
    }

    abstract protected function _render();

    public function getViewData() {
        return $this->_aViewData;
    }

    public function setViewData($sDataKey, $myData) {
        if ($sDataKey) {
            $this->_aViewData[$sDataKey] = $myData;
        }
    }

}
