<?php
/**
 * Created by PhpStorm.
 * User: hong
 * Date: 16-5-26
 * Time: 下午2:20
 */

require 'vendor/autoload.php';


use Symfony\Component\Console\Application;

$App = new Application();
$App->addCommands([
    new \Ace\Suggestion\Commands\InitIndex()
]);
$App->run();