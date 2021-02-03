<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register(){
  
        $this->renderable(function (NotFoundHttpException $e, $request)  {
            if( $request->is('api/*')){
                if ($e instanceof ModelNotFoundException) {
                        $model = strtolower(class_basename($e->getModel()));
                        return response()->json([
                            'meta' => [
                                'success' => false,
                                'error' => 'Model not found'
                            ]
                        ], 404);
                    }
                if ($e instanceof NotFoundHttpException) {
                        return response()->json([
                            'meta' => [
                                'success' => false,
                                'error' => 'Resource not found'
                            ]
                        ], 404);
                    }
            }
        });
    }
    
}
