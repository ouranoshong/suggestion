<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 16-5-27
 * Time: 下午2:57
 */

namespace Ace\Suggestion\MongoDriver;


use MongoDB\Driver\Manager;

class InitClient
{
    protected $_Client;
    
    public function Client() {
        if (is_null($this->_Client)) {
            $configs = self::parseConfig();
            if (isset($configs['uri'])) {
                $this->_Client = new Manager($configs['uri']);
            } else {
                throw new \Exception("mongodb uri未在配置文件声明。");
            }
        }
        return $this->_Client;
    }
}