<?php

namespace App\Exceptions;

use Exception;

class ConfigFileNotFoundException extends Exception
{
    public function showError(): string
    {
        return 'Error on line ' . $this->getLine() . ' in ' . $this->getFile()
            . ': <b>' . $this->getMessage() . '</b> File not found';
    }
}