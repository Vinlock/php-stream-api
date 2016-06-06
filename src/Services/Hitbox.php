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

    protected static $service = "hitbox";

    function __construct() {
        $streams = $this->service_construct(func_get_args());
        parent::__construct($streams);
    }

}