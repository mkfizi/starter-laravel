<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
        ]);
        
        $middleware->alias([
            'password.changed' => \App\Http\Middleware\EnsurePasswordChanged::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Handle authorization exceptions
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\HttpException $e, $request) {
            if ($e->getStatusCode() !== 403) {
                return null;
            }

            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized access.'], 403);
            }

            return redirect()->back()->with('error', 'You do not have permission to access requested resource.');
        });

        $exceptions->report(function (Throwable $e) {
            // Send error details via email
            if (config('app.error_send')) {
                
            // if (app()->environment('production')) {
                try {
                    $errorEmail = config('app.error_email');
                    
                    if ($errorEmail) {
                        // Create unique cache key based on error type and message
                        $cacheKey = 'error_email_sent_' . md5(get_class($e) . $e->getMessage() . $e->getFile() . $e->getLine());
                        
                        // Only send email if not sent in the last 60 minutes
                        if (!Cache::has($cacheKey)) {
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
                            
                            // Cache for 60 minutes to prevent duplicate emails
                            Cache::put($cacheKey, true, now()->addMinutes(60));
                        }
                    }
                } catch (\Exception $mailException) {
                    // Prevent infinite loop if mail fails
                }
            // }
            }
        });
    })->create();