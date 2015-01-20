<?php

class User extends ActiveRecord\Model {

    static $has_many = [
        ['messages']
    ];
    protected static $_sUserNamePrefix = 'user_';

    public function setRandomName() {
        $this->user_name = self::$_sUserNamePrefix . hash('crc32b', time() . rand(0, 666) . getmypid());
    }

    public static function getUserNamePrefix() {
        return self::$_sUserNamePrefix;
    }

}
