<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if (env('APP_DEBUG')) {
            return parent::render($request, $exception);
        }

        $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        $message = 'HTTP_INTERNAL_SERVER_ERROR';

        if ($exception instanceof HttpResponseException) {
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
        } elseif ($exception instanceof MethodNotAllowedHttpException) {
            $status = Response::HTTP_METHOD_NOT_ALLOWED;
            $message = 'HTTP_METHOD_NOT_ALLOWED';
            $exception = new MethodNotAllowedHttpException([], $message, $exception);
        } elseif ($exception instanceof NotFoundHttpException) {
            $status = Response::HTTP_NOT_FOUND;
            $message = 'HTTP_NOT_FOUND';
            $exception = new NotFoundHttpException($message, $exception);
        } elseif ($exception instanceof AuthorizationException) {
            $status = Response::HTTP_FORBIDDEN;
            $message = 'You are unauthorized';
            $exception = new AuthorizationException($message, $status);
        } elseif ($exception instanceof \Illuminate\Validation\ValidationException && $exception->getResponse()) {
            $status = Response::HTTP_BAD_REQUEST;
            $message = 'HTTP_BAD_REQUEST';
            $exception = new \Illuminate\Validation\ValidationException($message, $status, $exception);
        } elseif ($exception) {
            $exception = new HttpException($status, $message);
        }

        return response()->json([
            'success' => false,
            'status' => $status,
            'message' => $message,
        ], $status);
    }
}
