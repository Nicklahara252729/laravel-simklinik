<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Pemilik
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->profile->profile_name != "pemilik") {
            return response()->json([
                "result" => "error",
                "statusCode" => 200,
                "title" => "Anda bukan pemilik"
            ]);
        }

        return $next($request);
    }
}
