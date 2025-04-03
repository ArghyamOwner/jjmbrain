<?php

namespace App\Exceptions;

use Throwable;
use App\Traits\WithApiHelpers;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    use WithApiHelpers;
    
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
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
            Log::info($e);
        });

        $this->renderable(function (Throwable $e, $request) {
            if ($request->expectsJson()) {
                if ($e instanceof NotFoundHttpException) {
                    return $this->respondWithError(Response::HTTP_NOT_FOUND, 'Object Not Found');
                }

                if ($e instanceof ModelNotFoundException) {
                    return $this->respondWithError(Response::HTTP_NOT_FOUND, 'Entry for ' . str_replace('App\\', '', $e->getModel()) . ' not found.');
                }

                if ($e instanceof AuthenticationException) {
                    return $this->respondWithError(Response::HTTP_UNAUTHORIZED, 'Unauthenticated or Token Expired. Please Login');
                }

                if ($e instanceof ThrottleRequestsException) {
                    return $this->respondWithError(Response::HTTP_TOO_MANY_REQUESTS, 'Too many requests.');
                }

                if ($e instanceof ValidationException) {
                    return $this->respondWithError(Response::HTTP_UNPROCESSABLE_ENTITY, $e->getMessage(), $e->errors());
                }

                if ($e instanceof QueryException) {
                    return $this->respondWithError(Response::HTTP_INTERNAL_SERVER_ERROR, 'There was issue with the query.'.$e->getMessage());
                    // return $this->respondWithError(Response::HTTP_INTERNAL_SERVER_ERROR, 'There was issue with the query.'.$e->getMessage());
                }

                if ($e instanceof \Error) {
                    return $this->respondWithError(Response::HTTP_INTERNAL_SERVER_ERROR, "There was some internal error.");
                }
            }
        });
    }
}
