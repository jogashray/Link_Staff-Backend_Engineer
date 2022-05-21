<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use App\Exceptions\InvalidOrderException;
use Illuminate\Database\QueryException ;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        InvalidOrderException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            return response()->error("Internal Server Error.", 500);
        });
        $this->renderable(function (NotFoundHttpException $e, $request) {
            return response()->error("Object not found.", 404);
            
        });
        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            return response()->error("HTTP method not Found.", 404);
        });
        $this->renderable(function (\BadMethodCallException $e, $request) {
            return response()->error("Wrong method is called.", 404);
        });
        $this->renderable(function (QueryException $e, $request) {
            return response()->error("Something wrong in database connection.", 500);
        });
        $this->renderable(function (InvalidOrderException $e, $request) {
            return response()->error("Internal Server Error.", 500);
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->error("Unauthenticated.", 401);
    }
}
