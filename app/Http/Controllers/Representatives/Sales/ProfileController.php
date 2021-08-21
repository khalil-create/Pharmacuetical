<?php

namespace App\Http\Controllers\Representatives\Sales;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function profile($id)
    {
        $user = User::findOrfail($id);
        return view('representatives.repSales.profile',compact('user')); 
    }
}
