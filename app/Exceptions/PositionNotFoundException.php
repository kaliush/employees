<?php

namespace App\Exceptions;

use Exception;

class PositionNotFoundException extends Exception
{
    public function render()
    {
        return response()->json([
            'error' => 'Position not found.',
        ], 404);
    }
}
