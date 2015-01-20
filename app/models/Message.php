<?php

class Message extends ActiveRecord\Model {

    static $belongs_to = [
        ['user']
    ];
    // must have a text
    static $validates_presence_of = [
        ['message_text'], ['user_id']
    ];

    public function getMessText($blFull = true) {
        $sResText = '';
        if ($blFull) {
            $sResText = $this->message_text;
        } else {
            $oConf = Conf::getInstance();
            $iMessLength = $oConf->getConfParam('iOldestMessLength');
            $sAppEnc = $oConf->getConfParam('sAppEnc');

            if (mb_strlen($this->message_text, $sAppEnc) > $iMessLength) {
                $sResText = mb_substr($this->message_text, 0, $iMessLength, $sAppEnc) . '...';
            } else {
                $sResText = $this->message_text;
            }
        }

        return nl2br($sResText);
    }

    public function save($validate = true) {
        $this->_formatMsg();

        return parent::save($validate);
    }

    protected function _formatMsg() {
        $sUserMarker = Conf::getInstance()->getconfParam('sUserMarker');
        $sPattern = '~' . $sUserMarker . User::getUserNamePrefix() . '([\w]+)~ui';
        $sReplacement = '<b>' . $sUserMarker . User::getUserNamePrefix() . '$1</b>';

        $this->message_text = preg_replace($sPattern, $sReplacement, strip_tags($this->message_text));
    }

}
