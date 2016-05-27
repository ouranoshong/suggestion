<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 16-5-26
 * Time: 下午4:51
 */

namespace Ace\Suggestion\ESDriver;

use Elasticsearch\ClientBuilder;

trait InitClient
{
    
    protected $_Client;
    
    public function Client()
    {
        if(is_null($this->_Client)){
            $configs = self::parseConfig();
            if (isset($configs['hosts'])) {
                $this->_Client = ClientBuilder::create()->setHosts($configs['hosts'])->build();
            } else{
                throw new \Exception("Elastic Search可能未安装或未在配置文件声明。");
            }
        }
        return $this->_Client;
    }
}