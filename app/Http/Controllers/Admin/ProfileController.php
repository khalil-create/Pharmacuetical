<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function profile($id)
    {
        $user = User::findOrfail($id);
        // return $manager->supervisors;
        return view('admin.profile',compact('user')); 
    }
}
