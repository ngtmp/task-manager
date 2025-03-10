<?php

namespace App\Exceptions;

use Illuminate\Http\Request;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Validation\ValidationException;
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

        $this->renderable(function (NotFoundHttpException $e, Request $request) {
            return response()->json([
                'title' => 'Error',
                'message' => $e->getMessage() ?? 'Not found',
            ], 404);
        });

        $this->renderable(function (MethodNotAllowedHttpException $e, Request $request) {
            return response() ->json([
                'title' => 'Error',
                'message' => 'Method is not allowed',
            ], 405);
        });

        $this->renderable(function (ValidationException $e, Request $request) {
            return response()->json([
                'title' => 'Error',
                'message' => $e->getMessage(),
            ], 422);
        });
    }
}
