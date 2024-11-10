<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if( Auth::check() && Auth::user()->level == 1) {
            return $next($request);
        }else{
            Auth::logout();
            return redirect('/login')->with('error', ' Vui lòng đăng nhập với tài khoản quản trị.');
        }






        // if( Auth::check() && Auth::user()->level == 1) {
        //     return $next($request);
        // }elseif(Auth::check() && Auth::user()->level == 0){      
        //     return redirect('/member/account');
        // }else{
        //     Auth::logout();
        //     return redirect('/login')->with('error', 'Bạn không có quyền truy cập vào trang này.');
        // }
    }
}
