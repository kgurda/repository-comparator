<?php

namespace App\Exceptions;

use Throwable;

class GithubServiceUnavailableException extends \Exception
{
    protected $message;

    /**
     * GithubServiceUnavailableException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "Github service unavailable", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}