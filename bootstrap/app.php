<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\EnsureMobileIsVerified;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            'optional.auth' => \App\Http\Middleware\OptionalAuth::class,
            //'mobile.verified' => EnsureMobileIsVerified::class,
            'mobile.verified' => \App\Http\Middleware\EnsureMobileIsVerified::class,
        ]);
        $middleware->validateCsrfTokens(except: [
            '/success',
            '/cancel',
            '/fail',
            '/ipn',
            '/pay-via-ajax', // only required to run example codes. Please see bellow.
        ]);
        // $middleware->web(append: [
        //     EnsureMobileIsVerified::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
