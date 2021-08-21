<?php

namespace App\Http\Controllers\Representatives\Science;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function profile($id)
    {
        $user = User::findOrfail($id);
        return view('representatives.repScience.profile',compact('user'));
    }
}
