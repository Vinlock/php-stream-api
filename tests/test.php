<?php

error_reporting(-1);
ini_set('display_errors', 'On');


require_once ("../vendor/autoload.php");

\Vinlock\StreamAPI\StreamDriver::setLimit(10);

$bladeandsoul_twitch = \Vinlock\StreamAPI\Services\Twitch::game("Blade and Soul");
$overwatch_twitch = \Vinlock\StreamAPI\Services\Twitch::game("Overwatch");

$merge = \Vinlock\StreamAPI\Services\Service::mergeMulti(
    $bladeandsoul_twitch,
    $overwatch_twitch
);
var_dump($merge);
die();
header('Content-Type: application/json');
echo $merge->getJSON();