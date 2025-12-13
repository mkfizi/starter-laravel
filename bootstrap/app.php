<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Mail;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'password.changed' => \App\Http\Middleware\EnsurePasswordChanged::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->report(function (Throwable $e) {
            if (app()->environment('production')) {
                try {
                    $errorEmail = config('app.error_email');
                    
                    if ($errorEmail) {
                        Mail::raw(
                            "Exception: " . $e->getMessage() . "\n\n" .
                            "File: " . $e->getFile() . "\n" .
                            "Line: " . $e->getLine() . "\n\n" .
                            "Stack Trace:\n" . $e->getTraceAsString(),
                            function ($message) use ($errorEmail) {
                                $message->to($errorEmail)
                                        ->subject('[' . config('app.name') . '] Error Occurred - ' . date('Y-m-d H:i:s'));
                            }
                        );
                    }
                } catch (\Exception $mailException) {
                    // Prevent infinite loop if mail fails
                }
            }
        });
    })->create();
