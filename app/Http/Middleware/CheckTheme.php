<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTheme
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $theme = $request->cookie('theme');

        if (!$theme) {
            $response = $next($request);

            if ($response instanceof \Illuminate\Http\Response) {
                $response->withCookie(cookie()->forever('theme', config('app.theme')));
            }

            return $response;
        }

        return $next($request);
    }
}
