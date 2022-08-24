<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateSession 
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if($user && (!$user->status)) {
            if(!$user->status){
                return redirect()->route('admin.login')->with(Auth::logout());
            }else{
                return redirect()->route('login')->with(Auth::logout());
            }
        }
        return $next($request);
    }
}
