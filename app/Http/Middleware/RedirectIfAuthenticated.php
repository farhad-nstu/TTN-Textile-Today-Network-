<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated {
    
    public function handle($request, Closure $next, $guard = null){
        
        if($guard == 'admin' && Auth::guard($guard)->check()){
            if($request->method()=='POST' && $request->path() == 'controller/logout'){ //admin logout
                Auth::guard('admin')->logout();
                $request->session()->flush();
                $request->session()->regenerate();
                return redirect()->route( 'admin_login' );
            }else{
                return redirect('/admin/dashboard');
            }
        }
        
        if (Auth::guard($guard)->check()) {            
            return redirect('/home');
        }

        return $next($request);
    }
}
