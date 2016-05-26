<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 16-5-26
 * Time: 下午4:58
 */

namespace Ace\Suggestion\ESDriver;

use Ace\Suggestion\Suggestion;

trait ManagementOperate
{
    public function initIndex() {

        $params = [
            'index' => self::name(),
            'body' => [
                'mappings' => array_reduce(array_keys(Suggestion::types()),
                    function($mappings, $type) {
                        $mappings = array_merge((array)$mappings, $this->generateTypeProperties($type));
                        return $mappings;
                    }
                )
            ]
        ];

        return $this->Client()->indices()->create($params);
    }

    public function deleteIndex() {
        return $this->Client()->indices()->delete(['index'=> self::name()]);
    }

    public function createTypeMapping($type) {
        if ($type) {
            $params = [
                'index' => self::name(),
                'type' => $type,
                'body' => [
                    $this->generateTypeProperties($type)
                ]
            ];
            return $this->Client()->indices()->putMapping($params);
        }
    }

    public function generateTypeProperties($type) {
        $properties = [];
        $properties[$type] =[
            "properties" => [
                "name" => [ "type" => "string" ],
                "suggest" => [ "type" => "completion",
                    "analyzer" => "simple",
                    "search_analyzer" => "simple",
                    "payloads" => true
                ]
            ]
        ];
        return $properties;
    }
}