<?php

namespace App\Http\Controllers\Managers\sales;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile($id)
    {
        $user = User::findOrfail($id);
        return view('managers.sales.profile',compact('user'));
    }
}
