<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureMobileIsVerified
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user() || !$request->user()->mobile_verified_at) {
            return redirect()->route('verification.notice');
        }

        return $next($request);
    }
}