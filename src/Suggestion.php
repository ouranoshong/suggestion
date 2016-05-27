<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 16-5-26
 * Time: 下午3:10
 */

namespace Ace\Suggestion;

use \Ace\Suggestion\Contracts\Suggestion as SugguestionContract;

class Suggestion implements SugguestionContract
{

    /**
     *
     */
    const TYPE_DEFAULT = 'default';

    
    /**
     * @return array
     */
    public static function types() {
        return [
            Suggestion::TYPE_DEFAULT => Suggestion::TYPE_DEFAULT,
        ];
    }


}