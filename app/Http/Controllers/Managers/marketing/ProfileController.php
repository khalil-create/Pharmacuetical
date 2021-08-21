<?php

namespace App\Http\Controllers\Managers\marketing;

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
        $manager = $user->manager->first();
        // return $manager->supervisors;
        return view('Managers.marketing.profile',compact('user'))->with('manager',$manager); 
    }
}
