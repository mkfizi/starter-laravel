<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Priority: URL parameter > Session/User preference > Browser > Default
        if ($request->has('lang')) {
            $locale = $request->get('lang');
            session(['locale' => $locale]);
            
            if (Auth::check()) {
                Auth::user()->update(['locale' => $locale]);
            }
        } elseif (Auth::check()) {
            // For authenticated users, prefer session over DB (for recent changes)
            // Then sync session to DB for persistence
            if (session()->has('locale')) {
                $locale = session('locale');
                // Update user's DB preference to match session
                if (Auth::user()->locale !== $locale) {
                    Auth::user()->update(['locale' => $locale]);
                }
            } else {
                // Use user's saved preference
                $locale = Auth::user()->locale ?? 'en';
                session(['locale' => $locale]);
            }
        } elseif (session()->has('locale')) {
            $locale = session('locale');
        } else {
            $locale = $request->getPreferredLanguage(['en', 'ms']) ?? 'en';
        }

        App::setLocale($locale);
        
        return $next($request);
    }
}
