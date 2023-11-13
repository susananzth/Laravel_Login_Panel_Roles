<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            return route('login');
        }

        // Si la solicitud espera una respuesta JSON, devuelve una respuesta JSON personalizada.
        return response()->json([
            'status' => 401,
            'message' => 'Unauthorized',
            'data' => null
        ], 401);
    }
}
