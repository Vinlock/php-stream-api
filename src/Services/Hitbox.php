<?php
/**
 * Created by PhpStorm.
 * User: dakfi
 * Date: 5/30/2016
 * Time: 12:18 AM
 */

namespace Vinlock\StreamAPI\Services;


use Vinlock\StreamAPI\StreamDriver;

class Hitbox extends Service {

    function __construct($usernames) {
        if (!is_array($usernames) && is_string($usernames)) {
            $array = [$usernames];
        }

        $this->streams = StreamDriver::getStream($usernames, 'hitbox');
    }

    public static function game($game) {
        $streams = StreamDriver::byGame($game, 'hitbox');
        return new Service($streams);
    }

}