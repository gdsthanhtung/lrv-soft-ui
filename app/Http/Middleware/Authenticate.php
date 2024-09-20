<?php

namespace App\Http\Middleware;
use Closure;
use Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        //return $request->expectsJson() ? null : route('login');
        if (!Auth::check()) { // chưa đăng nhập
            return redirect()->route('login');
        }else{
            $user = Auth::user();
            $route = $request->route()->getName();
            dump($user->can($route));
            return $next($request);
        }
    }
}
