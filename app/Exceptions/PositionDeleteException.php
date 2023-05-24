<?php

namespace App\Exceptions;

use Exception;

class PositionDeleteException extends Exception
{
    public function render()
    {
        return response()->json([
            'error' => 'Failed to delete position.',
        ], 500);
    }
}
