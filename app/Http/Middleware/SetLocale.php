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
        // Priority: URL parameter > User preference > Session > Browser > Default
        if ($request->has('lang')) {
            $locale = $request->get('lang');
            session(['locale' => $locale]);
            
            if (Auth::check()) {
                Auth::user()->update(['locale' => $locale]);
            }
        } elseif (Auth::check() && Auth::user()->locale) {
            $locale = Auth::user()->locale;
        } elseif (session()->has('locale')) {
            $locale = session('locale');
        } else {
            $locale = $request->getPreferredLanguage(['en', 'ms']) ?? 'en';
        }

        App::setLocale($locale);
        
        return $next($request);
    }
}
