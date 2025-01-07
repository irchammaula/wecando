<?php

use App\Http\Middleware\CekLogin;
// use App\Http\Middleware\RoleMiddleware;
// use App\Models\Role;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->append(CekLogin::class);
        // $middleware->append(Role::class);
        // $middleware->append(RoleMiddleware::class);
        $middleware->validateCsrfTokens(except: [
            'http://845b-180-253-67-249.ngrok-free.app/callback',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
