<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Support\Arr;
use Illuminate\Auth\AuthenticationException;

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
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Handle unauthenticated exceptions.
     * 
     * @return redirect()
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' =>  $exception->getMessage()], 401);
        }

        $guard = Arr::get($exception->guards(), 0);

        switch ($guard) {
            case 'administrator-web':
                $login = 'administrator.sign-in-form';
                break;

            default:
                $login = 'users.sign-in-form';
                break;
        }

        return redirect()->guest(route($login));
    }
}
