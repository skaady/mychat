<?php

class User extends ActiveRecord\Model {

    /**
     * Has Many relations
     * 
     * @var array
     */
    static $has_many = [
        ['messages']
    ];
    
    /**
     * User name prefix
     * 
     * @static
     * @var string
     */
    protected static $_sUserNamePrefix = 'user_';

    /**
     * set random name for new user
     *  
     * @return null
     */
    public function setRandomName() {
        $this->user_name = self::$_sUserNamePrefix . hash('crc32b', time() . rand(0, 666) . getmypid());
    }

    /**
     * Return user name prefix
     * 
     * @static
     * @return string
     */
    public static function getUserNamePrefix() {
        return self::$_sUserNamePrefix;
    }

}
