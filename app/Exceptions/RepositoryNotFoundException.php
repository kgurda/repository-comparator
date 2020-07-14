<?php

namespace App\Exceptions;

use Throwable;

class RepositoryNotFoundException extends \Exception
{
    protected $status = 404;
    protected $message;

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}