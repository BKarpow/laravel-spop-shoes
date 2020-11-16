<?php

namespace App\Http\Middleware;

use App\Models\ApiToken;
use Closure;
use Illuminate\Http\Request;

class ApiTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $ApiToken = new ApiToken();
        $token = $request->input('token', '');
        if (empty($token) || !$ApiToken->tokenVerify($token)){
            sleep(1);
            die('{"status": false,"error": "Error token"}');
        }
        return $next($request);
    }
}
