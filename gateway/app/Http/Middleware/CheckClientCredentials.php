<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;

class CheckClientCredentials
{
    public function handle($request, Closure $next, ...$scopes)
    {
        $header = $request->header('Authorization');
        
        // Temporary debug - remove after testing
        if (!$header) {
            return response()->json(['error' => 'No Authorization header found'], 401);
        }

        if (!str_starts_with($header, 'Bearer ')) {
            return response()->json(['error' => 'Must start with Bearer', 'header' => $header], 401);
        }

        return $next($request);
    }
}