<?php

error_reporting(-1);
ini_set('display_errors', 'On');


require_once ("../vendor/autoload.php");

\Vinlock\StreamAPI\StreamDriver::setLimit(10);

$bladeandsoul_twitch = \Vinlock\StreamAPI\Services\Twitch::game("Blade and Soul");
$bladeandsoul_hitbox = \Vinlock\StreamAPI\Services\Hitbox::game("Blade and Soul");
$overwatch_twitch = \Vinlock\StreamAPI\Services\Twitch::game("Overwatch");
$overwatch_hitbox = \Vinlock\StreamAPI\Services\Hitbox::game("Overwatch");

$merge = \Vinlock\StreamAPI\Services\Service::merge(
    $bladeandsoul_twitch,
    $bladeandsoul_hitbox,
    $overwatch_twitch,
    $overwatch_hitbox
);
//var_dump($merge);
header('Content-Type: application/json');
echo $merge->getJSON();