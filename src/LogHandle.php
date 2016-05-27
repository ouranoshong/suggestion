<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 16-5-27
 * Time: 下午3:12
 */

namespace Ace\Suggestion;

use GuzzleHttp\Ring\Client\StreamHandler;
use Monolog\Logger;

trait LogHandle
{
    /**
     * @var Monolog\Logger
     */
    public $Logger;

    /**
     * @return \Monolog\Logger
     */
    public function Logger() {
        if (is_null($this->Logger)) {
            $debug = DEBUG === 1 ? Logger::DEBUG : Logger::INFO;
            $this->Logger = new Logger(__CLASS__);
            $this->Logger->pushHandler(new StreamHandler('php://stdout', $debug));
        }
        return $this->Logger;
    }
}