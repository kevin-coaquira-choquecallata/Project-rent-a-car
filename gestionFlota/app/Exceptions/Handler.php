<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $levels = [];

    protected $dontReport = [];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        //
    }

protected function invalidJson($request, ValidationException $exception)
{
    if (! $request->expectsJson()) {
        return redirect()->back()
            ->withErrors($exception->validator)
            ->withInput();
    }

    return response()->json([
        'message' => $exception->getMessage(),
        'errors' => $exception->errors(),
    ], $exception->status);
}

}
