<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Laravel\Sanctum\Exceptions\MissingAbilityException;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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

    public function render($request, Throwable $e)
    {
        // invalid token
        if ($e instanceof AuthenticationException) {
            return response()->json([
                "status"=> "unauthenticated",
                "message"=>"Invalid token",
            ]);
        }

        // user not admin
        if ($e instanceof MissingAbilityException) {
            return response()->json([
                "status"=> "forbidden",
                "message"=> "You are not the administrator"
            ], 403);
        }

        // url not found
        if ($e instanceof NotFoundHttpException) {
            return response()->json([
                "status"=> "not-found",
                "message"=> "Not found"
            ], 404);
        }

        // model not found
        if ($e instanceof ModelNotFoundException) {
            $model = $e->getModel();
            $model = explode('\\', $model)[2];
            return response()->json([
                'status' => 'not-found',
                'mesasage' => $model . ' Not found'
            ]);
        }

        return parent::render($request, $e);
    }
}
