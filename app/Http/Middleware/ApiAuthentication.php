<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiAuthentication
{

    const API_KEY_HEADER = 'x-api-key';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header(self::API_KEY_HEADER);

        if ($token === null) {
            return response()->json('Unauthorized', 401);
        }
        return $next($request);
    }
}
