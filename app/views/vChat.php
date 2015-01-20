<?php

class vChat extends AbstractView {
    public function fetchTpl(){
        $this->_sTplName = Conf::getInstance()->getConfParam('sTplRoot') . 'chat.php';
        
        return $this->_processTpl();
    }
}
