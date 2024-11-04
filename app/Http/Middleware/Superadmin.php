<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class Superadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->profile->profile_name != "superadmin" && Auth::user()->profile->profile_name != "pemilik" && Auth::user()->profile->profile_name != "operator") {
            return Redirect::back()->with([
                "error" => "Anda tidak memiliki akses"
            ]);
        }

        return $next($request);
    }
}