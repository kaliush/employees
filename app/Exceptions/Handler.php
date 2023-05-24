<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e): Response|JsonResponse|\Symfony\Component\HttpFoundation\Response
    {
        if ($e instanceof EmployeeCreationException) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        if ($e instanceof EmployeeUpdateException) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        if ($e instanceof EmployeeDeleteException) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        if ($e instanceof PositionNotFoundException) {
            return response()->json(['error' => $e->getMessage()], 404);
        }

        if ($e instanceof PositionDeleteException) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        if($e instanceof InvalidManagerException) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        if($e instanceof FileDeletionException) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return parent::render($request, $e);
    }
}
