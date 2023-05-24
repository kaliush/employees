<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class FileDeletionException extends Exception
{

    /**
     * @param string $string
     * @param int|mixed $getCode
     * @param \Exception|FileNotFoundException $e
     */
    public function __construct(string $message = '', int $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

