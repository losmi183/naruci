<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\JWTServices;
use Symfony\Component\HttpFoundation\Response;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if($token === null) {
            return response()->json([
                'errors' => __('auth.no bearer token in request')                
            ], status: Response::HTTP_UNAUTHORIZED);
        }

        // Get JWTServices singleton
        $jwtService = app(JWTServices::class);
        
        $status = $jwtService->decodeJWT($token);

        // main token is valid
        if ($status === 200) {
            return $next($request);
        }

        if($status === Response::HTTP_FORBIDDEN) {
            return response()->json([
                'errors' => __('auth.expeired token')                
            ], $status);
        }        

        return response()->json([
            'errors' => __('auth.invalid token')                
        ], $status);
    }
}
