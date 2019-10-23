<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
class Handler extends ExceptionHandler
{
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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'error' => [
                    'status' =>  404,
                    'message' =>  'Item not found.'
                ]
            ], 404);
        }

        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'error' => [
                    'status' =>  404,
                    'message' =>  'Resource not found.'
                ]
            ], 404);
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'error' => [
                    'status' =>  405,
                    'message' =>  'Method not allowed.'
                ]
            ], 405);
        }

        if ($exception instanceof UnauthorizedHttpException) {
            return response()->json([
                'error' => [
                    'status' =>  401,
                    'message' =>  'Unauthorized. Full authentication is required to access this resource.'
                ]
            ], 401);
        }

        if ($exception instanceof AccessDeniedHttpException) {
            return response()->json([
                'error' => [
                    'status' =>  403,
                    'message' =>  'Forbidden, Access Denied.'
                ]
            ], 403);
        }

        if ($exception instanceof HttpException) {
            return response()->json([
                'error' => 500,
                'message' => 'Internal Server error.'
            ], 500);
        }

        if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
            return response()->json([
                'responseMessage' => 'You do not have the required authorization.',
                'responseStatus'  => 403,
            ]);
        }
        return parent::render($request, $exception);
    }
}
