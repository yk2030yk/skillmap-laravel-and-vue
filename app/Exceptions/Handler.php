<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Http\Requests\ApiRequest;

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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
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
        // API系はJSONのレスポンスを返す
        if ($request->is('api/*')) {
            $status = 500;
            if ($this->isHttpException($exception)) {
                $status = $exception->getStatusCode();
            }

            $response = (new ApiRequest())->getResponseFormat();
            if ($status == 400) {
                $response['result_code'] = 0;
                $response['status_code'] = $status;
                $response['status']      = 'Bad Request';
            } else if ($status == 404) {
                $response['result_code'] = 0;
                $response['status_code'] = $status;
                $response['status']      = 'Not Found';
            } else if ($status == 500) {
                $response['result_code'] = 0;
                $response['status_code'] = $status;
                $response['status']      = 'Internal Server Error';
            } else {
                $response['result_code'] = 0;
                $response['status_code'] = $status;
                $response['status']      = 'Internal Server Error';
            }
            return response()->json($response);
        }
        return parent::render($request, $exception);
    }
}
