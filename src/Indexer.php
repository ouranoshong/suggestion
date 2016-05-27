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
use Ace\Suggestion\ESDriver\SuggestionHandle;
use Ace\Suggestion\Contracts\Indexer\SuggestionHandle as SugestionContract;

class Indexer implements SugestionContract
{
    use ConfigHandle,
        InitClient,
        ManagementOperate,
        SuggestionHandle;
}