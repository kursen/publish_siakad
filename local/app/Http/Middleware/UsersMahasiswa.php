<?php

namespace App\Http\Middleware;

use Closure;

class UsersMahasiswa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard=null)
    {
        if(Auth::guard($guard)->check()){

            return redirect('login_users_mahasiswa');
        }
        return $next($request);
    }
}
