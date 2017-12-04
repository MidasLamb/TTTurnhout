<?php

namespace App\Http\Middleware;

use Closure;

class Headers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response =  $next($request);

        $response->header('Strict-Transport-Security', 'max-age=63072000'); //HSTS
        $response->header("X-Frame-Options", "DENY"); // X-Frame
        $response->header("Content-Security-Policy", "default-src https: 'unsafe-inline'; frame-ancestors 'none'");

        return $response;
    }
}
