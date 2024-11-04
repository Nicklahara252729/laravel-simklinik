<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Patient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->profile->profile_name != "pasien") {
            return response()->json([
                "result" => "error",
                "statusCode" => 200,
                "title" => "Anda bukan pasien"
            ]);
        }
        return $next($request);
    }
}
