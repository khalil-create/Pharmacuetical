<?php

namespace App\Http\Controllers\Representatives\Sales;
use App\Http\Controllers\Controller;
use App\Models\User;
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
