<?php

abstract class AbstractController {

    /**
     * View name for rendering
     * 
     * @var string
     */
    protected $_sViewName = null;

    /**
     * View data array
     * 
     * @var array
     */
    protected $_aViewData = [];

    /**
     * Conf object
     * 
     * @var Conf
     */
    protected $_oConf = null;

    
    public function __construct(Conf $oConf) {
        $this->_oConf = $oConf;
    }

    /**
     * This method will be calling after each action;
     * Prepare View data. Return View name
     * 
     * @return string
     */
    abstract protected function _render();

    /**
     * Return View data array
     * 
     * @return array
     */
    public function getViewData() {
        return $this->_aViewData;
    }

    /**
     * Set View data to assoc array
     * 
     * @param string $sDataKey array key
     * @param mixed $myData data
     * @return null
     */
    public function setViewData($sDataKey, $myData) {
        if ($sDataKey) {
            $this->_aViewData[$sDataKey] = $myData;
        }
    }

}
