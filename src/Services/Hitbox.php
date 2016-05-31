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

    function __construct() {
        $array = func_get_args();
        $usernames = [];
        foreach ($array as $param) {
            if (is_array($param)) {
                $usernames = $param;
            } elseif (is_string($param)) {
                array_push($usernames, $param);
            }
        }
        $this->streams = StreamDriver::getStream($usernames, 'hitbox');
    }

    public static function game() {
        $limit = StreamDriver::NUM_PER_MULTI;
        $all_streams = [];
        foreach (func_get_args() as $param) {
            if (is_int($param)) {
                $limit = $param;
            } elseif (is_string($param)) {
                $all_streams = array_merge($all_streams, StreamDriver::byGame($param, 'hitbox', $limit));
            }
        }
        $streams = new Service($all_streams);
        $streams->sort();
        return $streams;
    }

}