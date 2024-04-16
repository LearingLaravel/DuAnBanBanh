<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        //dd("phải cần có quyền truy cập admin");
        if(Auth::check()){
            $user=Auth::user();
            if($user->level==2){
                return $next($request);
            }
            else {
                return redirect('/signin');
            }
        }
        else {
            return redirect('signin');
        }
    }
}