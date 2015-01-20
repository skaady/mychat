<?php

class vChat extends AbstractView {
    
    /**
     * process template file with view data
     * 
     * @return string
     */
    public function fetchTpl(){
        $this->_sTplName = Conf::getInstance()->getConfParam('sTplRoot') . 'chat.php';
        
        return $this->_processTpl();
    }
}
