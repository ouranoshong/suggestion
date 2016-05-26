<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 16-5-26
 * Time: 下午3:10
 */

namespace Ace\Suggestion;

use Ace\Suggestion\ESDriver\ConfigHandle;
use Ace\Suggestion\ESDriver\InitClient;
use Ace\Suggestion\ESDriver\ManagementOperate;

class Indexer
{
    use ConfigHandle, InitClient, ManagementOperate;

}