<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userType = Auth::user()->user_type;
        $user = User::findOrfail(Auth::user()->id);
        if($userType == 'أدمن')
            return view('admin.home',compact('user'));
        else if($userType == 'مدير تسويق')
            return view('managers.marketing.home',compact('user'));
        else if($userType == 'مدير مبيعات')
            return view('managers.sales.home',compact('user'));
        else if($userType == 'مشرف')
            return view('supervisors.home',compact('user'));
        else if($userType == 'مندوب علمي' || $userType == 'مدير فريق')
            return view('representatives.repScience.home',compact('user'));
        else if($userType == 'مندوب مبيعات')
            return view('representatives.repSales.home',compact('user'));
    }
}
