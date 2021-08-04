<?php

namespace App\Http\Controllers\Mangers\sales;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index($id)
    {
        $user = User::findOrfail($id);
        return view('profile',compact('user')); 
    }
}
