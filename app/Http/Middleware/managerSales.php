<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class managerSales
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
        if($usertype != 'مدير مبيعات')
        {
            return redirect()->route('notAllowed');
        }
        return $next($request);
    }
}
