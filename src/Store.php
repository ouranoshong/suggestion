<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 16-5-27
 * Time: 下午2:37
 */

namespace Ace\Suggestion;

use Ace\Suggestion\MongoDriver\SuggestionHandle;

class Store
{
    use LogHandle, SuggestionHandle;
}