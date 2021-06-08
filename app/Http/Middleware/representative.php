<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class representative
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
        $usertype = Auth::user()->user_type;
        if($usertype != 'مدير فريق' || $usertype != 'مندوب علمي' || $usertype != 'مندوب مبيعات')
        {
            return redirect()->route('notAllowed');
        }
        return $next($request);
    }
}
