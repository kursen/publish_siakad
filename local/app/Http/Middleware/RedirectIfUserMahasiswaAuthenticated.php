<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class RedirectIfUserMahasiswaAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = 'usermahasiswas')
    {
       
         if (!Auth::guard($guard)->check()){
            
			 return redirect('/login-mahasiswa');
           
			}
         return $next($request);
   
         
    }
}
