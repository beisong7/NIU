<?php

namespace App\Http\Middleware;

use App\Traits\Auth\Auth;
use Closure;

class UserVerify
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
        if(!empty($username)){
            $user = $this->guard($username);
//            return response()->json($user);
            if(!empty($user)&& $user->valid){
                if($user->admin){
                    return redirect()->route('admin.dashboard');
                }
                return redirect()->route('dashboard');

            }
            session()->forget($username);
            return $next($request);
        }
        return $next($request);

    }
}
