<?php

namespace App\Http\Middleware;

use App\Models\ApiToken;
use Closure;

class AuthMiddleware
{
    public function handle($request, Closure $next)
    {
        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json([
                'error' => 'Token required',
                'code'  => 401
            ], 401);
        }

        $apiToken = ApiToken::where('token', $token)->first();

        if (!$apiToken) {
            return response()->json([
                'error' => 'Invalid token',
                'code'  => 401
            ], 401);
        }

        return $next($request);
    }
}