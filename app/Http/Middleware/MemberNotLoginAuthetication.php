<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberNotLoginAuthentication
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->level == 0) {          
            return redirect('/member/account')->with('info', 'Bạn đã đăng nhập.');
        }

        return $next($request);
    }
}