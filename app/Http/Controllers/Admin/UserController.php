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

class UserController extends Controller
{
    use userTrait;//for save images of users

    public function home()
    {
        return view('admin.home');
    }
    public function adduser()
    {
        return view('admin.addUser');
    }
    public function storeUser(Request $request)
    {
        // $rules = $this->getRules();
        // $messages = $this->getMessages();
        // $validator = Validator::make($request->all(),$rules,$messages);
        // if($validator->fails()){
        //     return redirect()->back()->withErrors($validator)->withInputs($request->all());
        // }

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
        if($request->Input('usertype') == 'مشرف'){
            //$id = auth()->user($request->Input('email'))->id;
            $sup = Supervisor::create(['user_id' => $user->id]);
            $sup->update();
        }
        elseif($request->Input('usertype') == 'مدير تسويق' || $request->Input('usertype') == 'مدير مبيعات')
        {
            Manager::create(['user_id' => $user->id]);
        }
        return redirect('/displayAllUsers')->with('status','تم إضافة البيانات بشكل ناجح');
    }

    //accountController
    public function getAllUsers()
    {
        // $users = User::select('id','user_name_third','user_surname','user_type',
        // 'sex','email','phone_number','user_image')->get();
        $users = User::select('id','user_name_third','user_surname','user_type',
        'sex','email','phone_number','user_image')->get();
        return view('admin.accounts')->with('users',$users);
    }

    public function editUser($id)
    {
        $user = User::findOrfail($id);
        return view('admin.editUser')->with('user',$user );
    }

    public function userUpdate(Request $request,$id)
    {
        $user = User::find($id);
        $file_name = $this->saveImage($request->file('userimage'),'images/users/');

        if(!$user)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
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
        
        $prevSupervisor = FALSE;
        $supervisorID = 0;
        $sup = Supervisor::get();
        foreach($sup as $s)
        {
            if($s->user_id == $id)
            {
                $prevSupervisor = TRUE;
                $supervisorID = $s->id;
            }
        }
        //$user->save();
        if($request->Input('usertype') == 'مشرف' && !($prevSupervisor)){ //edit user to new supervisor
            $sup = Supervisor::create(['user_id' => $user->id]);
            $sup->update();
        }
        else if($request->Input('usertype') != 'مشرف' && $prevSupervisor) //delete supervisor becuase converted to another type
        {
            $supdelet = Supervisor::find($supervisorID);
            $supdelet->delete();
        }
        return redirect('/displayAllUsers')->with('status','تم تعديل البيانات بشكل ناجح');
    }

    protected function getRules()
    {
        return $rules = [
                'usernamethird' => 'required|string|max:255',
                'usersurname' => 'required|string|max:255',
                'usertype' => 'string|max:255',
                'sex' => 'required|string|max:255',
                'birthdate' => 'required|string|max:255',
                'birthplace' => 'required|string|max:255',
                'town' => 'required|string|max:255',
                'village' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'phonenumber' => 'numeric|required|max:999999999',
                'identitytype' => 'required|string',
                'identitynumber' => 'required|numeric',
                'userimage' => 'required|string|max:255',
                'password' => 'required|string|min:6|confirmed',
            ];
    }
    protected function getMessages()
    {
        return $messages = [
            'usernamethird.required' => 'يجب عليك كتابة الاسم الثلاثي',
            'usersurname.required' => 'يجب عليك كتابة اللقب',
            'usertype.required' => 'يجب عليك كتابة النوع',
            'birthdate.required' => 'يجب عليك كتابة تأريخ الميلاد',
            'birthplace.required' => 'يجب عليك كتابة محل الميلاد',
            'town.required' => 'يجب عليك كتابة المديريه',
            'village.required' => 'يجب عليك كتابة العزلة',
            'email.required' => 'يجب عليك كتابة الايميل',
            'phonenumber.required' => 'يجب عليك كتابة رقم الهاتف',
            'identitytype.required' => 'يجب عليك كتابة نوع الهوية',
            'identitynumber.required' => 'يجب عليك كتابة رقم الهوية',
            'userimage.required' => 'يجب عليك تحميل الصورة',
            'password.required' => 'يجب عليك كتابة كلمة السر',

            'usernamethird.string' => ' يجب كتابة الاسم الثلاثي بشكل نصي',
            'usersurname.string' => ' يجب كتابة اللقب بشكل نصي',
            
        ];
    }
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        
        $supervisorID = 0;
        $sup = Supervisor::whereHas('user')->get();
        foreach($sup as $s)
        {
            if($s->user_id == $id)
            {
                $supervisorID = $s->id;
            }
        }
        $supDeleted = Supervisor::find($supervisorID);
        $mainarea = Mainarea::whereHas('supervisor')->get();
        $mainareaID = 0;
        foreach($mainarea as $s)
        {
            if($s->supervisor_id == $supDeleted->id)
            {
                $mainareaID = $s->id;
            }
        }
        
        if(!$user)
            return redirect()->back()->with(['error' => 'لا توجد بيانات لحذفها ']);
        else
        {
            $mainareaDeleted = Mainarea::find($mainareaID);
            $supDeleted->delete();
            $mainareaDeleted->delete();
            $user->delete();
            return redirect('/displayAllUsers')->with('status','تم حذف البيانات بشكل ناجح');
        }       
    }
}
