<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
        if (request('lang')) {
            session()->put('language', request('lang'));
            $language = request('lang');
        } elseif (session('language')) {
            $language = session('language');
        } elseif (config('app.locale')) {
            $language = config('app.locale');
        }

        if (isset($language) && config('app.languages.' . $language)) {
            app()->setLocale($language);
        }

        return $next($request);
    }
}
