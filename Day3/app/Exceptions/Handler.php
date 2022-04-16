<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Throwable;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
     * @param Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request, Throwable $exception)
    {

        // is this request asks for json?


            /*  is this exception? */

            if ( !empty($exception) ) {

                // set default error message
                $response = [
                    'error' => 'Sorry, can not execute your request.'
                ];

                // If debug mode is enabled
                if (config('app.debug')) {
                    // Add the exception class name, message and stack trace to response
                    $response['exception'] = get_class($exception); // Reflection might be better here
                    $response['message'] = $exception->getMessage();
                    $response['trace'] = $exception->getTrace();
                }

                $status = 400;

                // get correct status code

                // is this validation exception
                if($exception instanceof ValidationException){
                    Log::notice('Got validation error', ['exception' => $exception]);
                    return $this->convertValidationExceptionToResponse($exception, $request);

                    //is it DB exception
                }else if($exception instanceof \PDOException){
                    Log::critical('Got DB error', ['exception' => $exception]);
                    $status = 500;

                    $response['error'] = 'Can not finish your query request!';

                    // is it http exception (this can give us status code)
                }else if($exception instanceof ModelNotFoundException){
                    Log::notice('Got bad request', ['exception' => $exception]);
                    $status = 404;

                    $response['error'] = 'Request error!';

                }else if($this->isHttpException($exception)){
                    Log::critical('failure at controller', ['exception' => $exception]);
                    $status = $exception->getStatusCode();

                    $response['error'] = 'Request error!';

                }else{
                    Log::alert('unknown error', ['exception' => $exception]);
                    // for all others check do we have method getStatusCode and try to get it
                    // otherwise, set the status to 400
                    $status = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 400;

                }

                return response()->json($response,$status);

            }


        return parent::render($request, $exception);
    }
}
