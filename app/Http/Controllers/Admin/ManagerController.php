<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Supervisor;
use App\Models\Mainarea;
use App\Models\Manager;
use App\Traits\userTrait;
use App\Http\Controllers\Controller;
use App\Models\Representative;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Image;

class ManagerController extends Controller
{
    use userTrait;//for save images of users
    public function getAllManagers()
    {
        $managers = User::whereHas('managers')->get();
        return view('admin.manageManagers', compact('managers',$managers));
    }
    public function addManager()
    {
        return view('admin.addManager');
    }
    public function storeManager(Request $request)
    {
        $file_name = $this->saveImage($request->file('userimage'),'images/users/');
        
        $user = User::create([
            'user_name_third' => $request->usernamethird,
            'user_surname' => $request->usersurname,
            'user_type' => $request->usertype,
            'sex' => $request->sex,
            'birthdate' => $request->birthdate,
            'birthplace' => $request->birthplace,
            'town' => $request->town,
            'village' => $request->village,
            'email' => $request->email,
            'phone_number' => $request->phonenumber,
            'identity_type' => $request->identitytype,
            'identity_number' => $request->identitynumber,
            'user_image' => $file_name,
            'password' => bcrypt($request->password),
        ]);
            $manager = Manager::create(['user_id' => $user->id]);
            $manager->update();

        return redirect('/manageManagers')->with('status','تم إضافة البيانات بشكل ناجح');
    }
    public function editManager($id)
    {
        $user = User::findOrfail($id);
        return view('admin.editManager')->with('user',$user );
    }
    public function updateManager(Request $request,$id)
    {
        $user = User::find($id);
        if(!$user)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $file_name = $this->saveImage($request->file('userimage'),'images/users/');
        
        //$user->update($request->all());
        $user->user_name_third = $request->Input('usernamethird');
        $user->user_surname = $request->Input('usersurname');
        $user->user_type = $request->Input('usertype');
        $user->sex = $request->Input('sex');
        $user->birthdate = $request->Input('birthdate');
        $user->birthplace = $request->Input('birthplace');
        $user->town = $request->Input('town');
        $user->village = $request->Input('village');
        $user->email = $request->Input('email');
        $user->phone_number = $request->Input('phonenumber');
        $user->identity_type = $request->Input('identitytype');
        $user->identity_number = $request->Input('identitynumber');
        $user->password = bcrypt($request->Input('password'));
        if($request->hasfile('userimage'))
        {
            $user->user_image = $file_name;
        }
        $user->update();

        return redirect('/manageManagers')->with('status','تم تعديل البيانات بشكل ناجح');
    }
}
