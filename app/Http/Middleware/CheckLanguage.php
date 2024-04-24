<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class CheckLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $language = $request->cookie('language');

        if ($language) {
            App::setLocale($language);

            $response = $next($request);

            if ($response instanceof \Illuminate\Http\Response) {
                $response->withCookie(cookie()->forever('language', $language));
            }

            return $response;
        } else {
            App::setLocale(config('app.locale'));
            $response = $next($request);

            if ($response instanceof \Illuminate\Http\Response) {
                $response->withCookie(cookie()->forever('language', config('app.locale')));
            }

            return $response;
        }
    }
}
