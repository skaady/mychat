<?php

class Message extends ActiveRecord\Model {

    /**
     * Belongs to relation
     * 
     * @static
     * @var array
     */
    static $belongs_to = [
        ['user']
    ];

    /**
     * Required fields
     * 
     * @static
     * @var array
     */
    static $validates_presence_of = [
        ['message_text'], ['user_id']
    ];

    /**
     * Return message text
     * 
     * @param bool $blFull 
     * @return array
     */
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

    /**
     * Save model to db. Return false on failure.
     * 
     * @param bool $validate
     * @return bool
     */
    public function save($validate = true) {
        $this->_formatMsg();

        return parent::save($validate);
    }

    /**
     * Format message text before saving
     * 
     * @return null
     */
    protected function _formatMsg() {
        $sUserMarker = Conf::getInstance()->getconfParam('sUserMarker');
        $sPattern = '~' . $sUserMarker . User::getUserNamePrefix() . '([\w]+)~ui';
        $sReplacement = '<b>' . $sUserMarker . User::getUserNamePrefix() . '$1</b>';

        $this->message_text = preg_replace($sPattern, $sReplacement, strip_tags($this->message_text));
    }

}
