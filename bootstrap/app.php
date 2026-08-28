<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->trustProxies(at: '*');

        $middleware->validateCsrfTokens(except: [
            'payment/paystack/webhook',
        ]);

        // Unauthenticated redirect routing
        $middleware->redirectTo(
            guests: function (\Illuminate\Http\Request $request) {
                if ($request->is('manager*')) {
                    return route('manager.login');
                }
                return route('login');
            }
        );

        // ABAC role-based access control middleware alias
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
