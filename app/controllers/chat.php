<?php

class chat extends AbstractController {

    /**
     * Name of rendered View
     * 
     * @var string
     */
    protected $_sViewName = 'vChat';

    /**
     * This method calling after each action;
     * Prepare View data. Return View name
     * 
     * @return string
     */
    protected function _render() {
        $aMessages = Message::all([
                    'order' => 'message_id desc',
                    'limit' => $this->_oConf->getConfParam('iMessOnPage')
        ]);

        $this->setViewData('aMessages', $aMessages);

        return $this->_sViewName;
    }

    /**
     * Action Index.
     * Check user and update last login time
     * 
     * @return string
     */
    public function Index() {
        $oSess = Session::getInstance();
        $iTime = time();

        $blNewUser = true;

        if ($iUserId = $oSess->get('user_id') && $oUser = User::find($oSess->get('user_id'))) {//isset user id
            if ($iLastLogin = Request::getCookie('last_login')) {// and isset last login time
                if ($iTime - $iLastLogin <= $this->_oConf->getConfParam('iUserLifetime')) {//but n hours ago
                    $blNewUser = false;
                }
            }
        }

        if ($blNewUser) {//create new user if need
            $oUser = new User();
            $oUser->setRandomName();
            $oUser->save();

            $oSess->set('user_id', $oUser->user_id);
        } else {
            $oUser = (new User)->find($iUserId, ['include' => 'messages']);
        }

        Request::setCookie('last_login', $iTime, $iTime + $this->_oConf->getConfParam('iUserLifetime'));

        return $this->_render();
    }

    /**
     * Action AddMessage.
     * Add new message to D if Request is valid
     * 
     * @return string
     */
    public function AddMessage() {
        if (Request::isPost()) {
            $iUserId = Session::getInstance()->get('user_id');
            $oReq = Request::getInstance();

            $oUser = User::find($iUserId);

            $aMsgData = ['message_text' => $oReq->getRequestParam('message_text', ''), 'user_id' => $iUserId];
            if (Request::isAjax()) {
                $aMsgData['is_ajax'] = 1;
            }

            $oUser->create_messages($aMsgData);

            return $this->_render();
        }

        throw new Exception('Must be a post request!');
    }

}
