<?php

namespace App\Exceptions;

use PHPUnit\Event\Code\Throwable;

class EmployeeUpdateException extends \Exception
{

    /**
     * @param string $string
     * @param int $int
     * @param \Exception $e
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render($request)
    {
        return response()->json(['error' => $this->getMessage()], 500);
    }
}
