<?php

namespace App\Http\Controllers\Admin;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function registered()
    {
        $users = User::all();
        return view('admin.accounts')->with('users',$users);
    }

    public function registeredit(Request $request,$id)
    {
        $user = User::findOrfail($id);
        return view('admin.editUser')->with('user',$user);
    }

    public function registerupdate(Request $request,$id)
    {
        // $file_extension = $request['userimage']->getClientOriginalExtension();
        // $file_name = time().'.'.$file_extension;
        // $path = 'images/users';
        // $request['userimage']->move($path,$file_name);

        // $rules = $this->getRules();
        // $messages = $this->getMessages();
        // $validator = Validator::make($request->all, $rules,$messages);

        // if($validator->fails())
        // {
        //     $errors = $validator->errors()->first();
        //     return redirect()->back()->withErrors($validator)->withInputs($request->all());
        // }
        
        $user = User::find($id);
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
            $file = $request->file('userimage');
            $extention =$file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $path = 'images/users/';
            $file->move($path,$filename);
            $user->user_image = $filename;
        }
        $user->update();
        //$user->save();

        return redirect('/accounts')->with('status','تم تعديل البيانات بشكل ناجح');
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
                'user_image' => 'required|string|max:255',
                'password' => 'required|string|min:6|confirmed',
            ];
    }
    protected function getMessages()
    {
        return $massages = [
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
            'password.required' => 'يجب عليك كتابة كلمة السر',

            'usernamethird.string' => ' يجب كتابة الاسم الثلاثي بشكل نصي',
            'usersurname.string' => ' يجب كتابة اللقب بشكل نصي',
            
        ];
    }
    public function registerdelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/accounts')->with('status','تم حذف البيانات بشكل ناجح');        
    }
}
