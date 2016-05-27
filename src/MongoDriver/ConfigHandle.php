<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 16-5-27
 * Time: 下午2:50
 */

namespace Ace\Suggestion\MongoDriver;


trait ConfigHandle
{
    public static function parseConfig($name = '') {
        try {

            $fileName = $name ? : __DIR__ . '/../../config.yml';
            $config = Yaml::parse(file_get_contents($fileName));

            if (isset($config['store'])) {
                return $config['store'];
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