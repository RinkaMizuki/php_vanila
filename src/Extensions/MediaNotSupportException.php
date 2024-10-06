<?php

namespace App\Extensions;

use Exception;

class MediaNotSupportException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message, 415);
    }

    public function errorMessage(): string
    {
        return  'Error on line ' . $this->getLine() . ' in ' . $this->getFile()
            . ': Method <b>' . $this->getMessage() . '</b> is not support. Status code: ' . $this->getCode();
    }
}
