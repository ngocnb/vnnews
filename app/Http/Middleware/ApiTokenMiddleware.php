<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }
    public function handle($request, Closure $next)
    {
        $token = $request->header('Authorization');
        if (!$token) {
            return response()->json('Unauthorized', 401);
        }
        // Kiểm tra token trong DB
        $user = User::where('remember_token', $token)->first();
        if (!$user) {
            return response()->json('Unauthorized', 401);
        }

        // Lưu thông tin user vào request
        $request->user = $user;
        return $next($request);
    }
}
