<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class admin
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
        if(Auth::user()){
            $usertype = Auth::user()->user_type;
            if($usertype != 'أدمن')
            {
                return redirect()->route('notAllowed');
            }
            return $next($request);
        }
        else
            return redirect('login');
    }
}
