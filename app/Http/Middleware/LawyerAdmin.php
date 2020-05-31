<?php

namespace App\Http\Middleware;

use App\Traits\Auth\Auth;
use Closure;

class LawyerAdmin
{
    use Auth;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $username = session('current_user_name');

        $user = $this->guard($username);
        if($user->admin){
            return $next($request);
        }
        return redirect()->route('dashboard');

    }
}
