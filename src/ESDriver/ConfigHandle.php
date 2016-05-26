<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 16-5-26
 * Time: 下午3:34
 */

namespace Ace\Suggestion\ESDriver;

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

trait ConfigHandle
{

    public static function parseConfig($name = '') {
        try {

            $fileName = $name ? : __DIR__ . '/../../config.yml';
            $config = Yaml::parse(file_get_contents($fileName));

            if (isset($config['indexer'])) {
                return $config['indexer'];
            }

            return [];
            
        } catch (ParseException $e) {
            printf("Unable to parse the YAML string: %s", $e->getMessage());
            exit();
        }
    }

    public static function name() {
        $configs = self::parseConfig();
        if (isset($configs)) {
            return $configs['name'];
        }

        return 'suggestion';
    }
    
}