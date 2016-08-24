<?php
/**
 * Created by PhpStorm.
 * User: dakfi
 * Date: 5/29/2016
 * Time: 10:31 PM
 */

namespace Vinlock\StreamAPI\Exceptions;


class MultiStreamInstance extends APIError {

    protected $message = "You have attempted to set or get the variable while it is a Single Stream Instance.";

    protected $code = 400;

    public function __construct($var) {
        $message = "{$this->message} - \${$var} cannot be set.";

        parent::__construct($this->message, $this->code, NULL);
    }

}
