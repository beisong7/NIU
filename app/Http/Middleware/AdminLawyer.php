<?php

namespace App\Http\Middleware;

use App\Traits\Auth\Auth;
use Closure;
use Illuminate\Support\Facades\View;

class AdminLawyer
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
//        dd($username);
        if(!empty($username)){
            $user = $this->guard($username);
//            return response()->json($user);
            if(!empty($user)&& $user->valid && $user->admin){
                View::share('person', $user);
                return $next($request);
            }
            $this->logout();
            return redirect()->route('home');
        }

        return redirect()->route('home');
    }
}
