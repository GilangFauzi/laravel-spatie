<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Spatie\Permission\Exceptions\UnauthorizedException;
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

    // jika akses/permission bukan admin maka jalankan perintah berikut
    public function render($request, Throwable $e)
    {
        if($e instanceof UnauthorizedException) return response()->view('errors.index', ['exception' => $e->getMessage()], 403);

        // jika akses/permission benar jalankan parent
        return parent::render($request,$e);
    }
}
