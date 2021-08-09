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
use Illuminate\Support\Facades\DB;
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
        // $supervisors = Supervisor::get();
        $supervisors = Supervisor::get();
        
        $manager = Manager::get();
        $teemLeaders = Representative::with('user')->get();
        return view('admin.addUser',compact('supervisors'))->with('teemLeaders',$teemLeaders)
        ->with('manager',$manager);
    }
    public function storeUser(Request $request)
    {
        $usertype = $request->Input('usertype');
        $managerMarketing = User::where('user_type','مدير تسويق')->first();
        $managerSales = User::where('user_type','مدير مبيعات')->first();
        if($usertype == 'مشرف' )
        {
            if(!$managerMarketing || $managerMarketing->count() < 1)
                return redirect()->back()->with(['error' => 'لايمكنك اضافة مشرف قبل مايتم اضافة مدير التسويق']);
        }
        else if($usertype == 'مندوب مبيعات')
        {
            if(!$managerSales || $managerSales->count() < 1)
                return redirect()->back()->with(['error' => 'لايمكنك اضافة مندوب مبيعات قبل مايتم اضافة مدير المبيعات']);
        }
        else if($usertype == 'مدير فريق')
        {
            $sup = Supervisor::get();
            if(!$sup || $sup->count() < 1 && $usertype != 'مشرف')
                return redirect()->back()->with(['error' => 'لايمكنك اضافة مدير فريق قبل مايتم اضافة مشرف']);
        }
        else if($usertype == 'مندوب علمي')
        {
            $teemL = User::where('user_type','مدير فريق')->get();
            if(!$teemL || $teemL->count() < 1 && $usertype != 'مدير فريق')
                return redirect()->back()->with(['error' => 'لايمكنك اضافة مندوب قبل مايتم اضافة مدير فريق']);
        }
        
        // dd($request->all());
        // $rules = $this->getRules();
        // $messages = $this->getMessages();
        // $validator = Validator::make($request->all(),$rules,$messages);
        // if($validator->fails()){
        //     return redirect()->back()->withErrors($validator)->withInputs($request->all());
        // }
        // $file_name = $this->saveImage($request->file('userimage'),'images/users/');
        if($request->hasfile('userimage'))
        {
            $file_name = $this->saveImage($request->file('userimage'),'images/users/');
        }
        else{
            $file_name = null;
        }
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
        if($usertype == 'مشرف')
        {
            Supervisor::create([
                'user_id' => $user->id,
                'manager_id' => $managerMarketing->manager->id,
            ]);
        }
        else if($usertype == 'مدير تسويق' || $usertype == 'مدير مبيعات')
        {
            Manager::create(['user_id' => $user->id]);
        }
        else if($usertype == 'مدير فريق')
        {
            Representative::create([
                'user_id' => $user->id,
                'supervisor_id' => $request->supervisor_id,
            ]);
        }
        else if($usertype == 'مندوب علمي')
        {
            Representative::create([
                'user_id' => $user->id,
                'supervisor_id' => $request->supervisor_id,
                'teemLeader_id' => $request->teemleader_id,
            ]);
        }
        else if($usertype == 'مندوب مبيعات')
        {
            Representative::create([
                'user_id' => $user->id,
                'manager_id' => $managerSales->id, //لأنه مندوب مبيعات فإن المشرف الذي يتبعه هو مدير المبيعات
            ]);
        }
        return redirect('/admin/displayAllUsers')->with('status','تم إضافة البيانات بشكل ناجح');
    }

    //accountController
    public function getAllUsers()
    {
        $users = User::select('id','user_name_third','user_surname','user_type',
        'sex','email','phone_number','user_image')->get();
        return view('admin.accounts')->with('users',$users);
    }

    public function editUser($id)
    {
        $user = User::findOrfail($id);
        $supervisors = Supervisor::get();
        // $manager = Manager::get();
        $teemLeaders = Representative::with('user')->get();
        return view('admin.editUser',compact('user'))->with('supervisors',$supervisors)
        ->with('teemLeaders',$teemLeaders);
    }

    public function userUpdate(Request $request,$id)
    {
        $usertype = $request->Input('usertype');
        $managerMarketing = User::where('user_type','مدير تسويق')->first();
        $managerSales = User::where('user_type','مدير مبيعات')->first();
        if($usertype == 'مدير تسويق' && $managerMarketing->count() > 0 && $managerMarketing->id != $id)
        {
                return redirect()->back()->with(['error' => 'لايمكنك اضافة مدير التسويق فهناك يوجد مدير تسويق بالفعل ولا يمكنك اضافة اكثر من مدير تسويق واحد']);
        }
        else if($usertype == 'مدير مبيعات' && $managerSales->count() > 0 && $managerSales->id != $id)
        {
                return redirect()->back()->with(['error' => 'لايمكنك اضافة مدير التسويق فهناك يوجد مدير مبيعات بالفعل ولا يمكنك اضافة اكثر من مدير مبيعات واحد']);
        }
        else if($usertype == 'مشرف' )
        {
            if(!$managerMarketing || $managerMarketing->count() < 1)
                return redirect()->back()->with(['error' => 'لايمكنك اضافة مشرف قبل مايتم اضافة مدير التسويق']);
        }
        else if($usertype == 'مندوب مبيعات')
        {
            if(!$managerSales || $managerSales->count() < 1)
                return redirect()->back()->with(['error' => 'لايمكنك اضافة مندوب مبيعات قبل مايتم اضافة مدير المبيعات']);
        }
        else if($usertype == 'مدير فريق')
        {
            $sup = Supervisor::get();
            if(!$sup || $sup->count() < 1 && $usertype != 'مشرف')
                return redirect()->back()->with(['error' => 'لايمكنك اضافة مدير فريق قبل مايتم اضافة مشرف']);
        }
        else if($usertype == 'مندوب علمي')
        {
            $teemL = User::where('user_type','مدير فريق')->get();
            if(!$teemL || $teemL->count() < 1 && $usertype != 'مدير فريق')
                return redirect()->back()->with(['error' => 'لايمكنك اضافة مندوب قبل مايتم اضافة مدير فريق']);
        }

        $user = User::find($id);

        if(!$user)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
            
        if($user->user_type == $usertype)
        {
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
                $this->deleteFile($user->userimage,'images/users/');
                $file_name = $this->saveImage($request->file('userimage'),'images/users/');
                $user->user_image = $file_name;
            }
            else{
                $user->user_image = $user->user_image;
            }
            $user->update();
        }
        else
        {
            $userTemp = $user;
            $user->delete();
            if($request->hasfile('userimage'))
            {
                $this->deleteFile($user->userimage,'images/users/');
                $file_name = $this->saveImage($request->file('userimage'),'images/users/');
            }
            else{
                $file_name = $userTemp->user_image;
            }
            $user = User::create([
                'id' => $id,
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
            if($usertype == 'مشرف')
            {
                Supervisor::create([
                    'user_id' => $user->id,
                    'manager_id' => $managerMarketing->manager->id,
                ]);
            }
            else if($usertype == 'مدير تسويق' || $usertype == 'مدير مبيعات')
            {
                Manager::create(['user_id' => $user->id]);
            }
            else if($usertype == 'مدير فريق')
            {
                Representative::create([
                    'user_id' => $user->id,
                    'supervisor_id' => $request->supervisor_id,
                ]);
            }
            else if($usertype == 'مندوب علمي')
            {
                Representative::create([
                    'user_id' => $user->id,
                    'supervisor_id' => $request->supervisor_id,
                    'teemLeader_id' => $request->teemleader_id,
                ]);
            }
            else if($usertype == 'مندوب مبيعات')
            {
                Representative::create([
                    'user_id' => $user->id,
                    'manager_id' => $managerSales->id,//لأنه مندوب مبيعات فإن المشرف الذي يتبعه هو مدير المبيعات
                ]);
            }
        }
        // $prevSupervisor = FALSE;
        // $supervisorID = 0;
        // $sup = Supervisor::get();
        // foreach($sup as $s)
        // {
        //     if($s->user_id == $id)
        //     {
        //         $prevSupervisor = TRUE;
        //         $supervisorID = $s->id;
        //     }
        // }
        // //$user->save();
        // if($request->Input('usertype') == 'مشرف' && !($prevSupervisor)){ //edit user to new supervisor
        //     // $manager = Manager::get()->first();
        //     if(!$managerMarketing)
        //         return redirect()->back()->with(['error' => 'لايمكنك اضافة مشرف قبل مايتم اضافة مدير التسويق']);
        //     $sup = Supervisor::create(['user_id' => $user->id,'manager_id' => $managerMarketing->id]);
        //     $sup->update();
        // }
        // else if($request->Input('usertype') != 'مشرف' && $prevSupervisor) //delete supervisor becuase converted to another type
        // {
        //     $supdelet = Supervisor::find($supervisorID);
        //     $supdelet->delete();
        // }
        // if($request->Input('usertype') == 'مدير تسويق' || 'مدير مبيعات')
        // {
        //     Manager::create(['user_id' => $user->id]);
        // }
        // else if($request->Input('usertype') == 'مندوب فريق' || 'مندوب علمي' || 'مندوب مبيعات')
        // {
        //     Representative::create(['user_id' => $user->id]);
        // }
        return redirect('/admin/displayAllUsers')->with('status','تم تعديل البيانات بشكل ناجح');
    }

    protected function getRules()
    {
        return $rules = [
                'usernamethird' => 'required|string|max:255',
                'usersurname' => 'required|string|max:255',
                'usertype' => 'required|string|max:255',
                'sex' => 'required|string|max:255',
                'birthdate' => 'required|string|max:255',
                'birthplace' => 'required|string|max:255',
                'town' => 'required|string|max:255',
                'village' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'phonenumber' => 'numeric|required|max:999999999',
                'identitytype' => 'required|string|max:255',
                'identitynumber' => 'required|numeric||max:20',
                'userimage' => 'required|string',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required_with:password|same:password|min:6',
            ];
    }
    protected function getMessages()
    {
        return $messages = [
            'usernamethird.required' => 'يجب عليك كتابة هذا الحقل',
            'usernamethird.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'usernamethird.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',
            
            'usersurname.required' => 'يجب عليك كتابة هذا الحقل',
            'usersurname.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'usersurname.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',

            'birthdate.required' => 'يجب عليك كتابة هذا الحقل',
            'birthdate.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',

            'birthplace.required' => 'يجب عليك كتابة هذا الحقل',
            'birthplace.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'birthplace.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',

            'town.required' => 'يجب عليك كتابة هذا الحقل',
            'town.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'town.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',

            'village.required' => 'يجب عليك كتابة هذا الحقل',
            'village.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'village.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',

            'email.required' => 'يجب عليك كتابة هذا الحقل',
            'email.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'email.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',
            'email.unique' => 'هذا الايميل مستخدم لدى مستخدم اخر',
            'email.email' => 'هذا ليس بريد اكتروني',

            'phonenumber.required' => 'يجب عليك كتابة هذا الحقل',
            'phonenumber.numeric' => 'يجب ان يكون هذا الحقل رقم',
            'phonenumber.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 9',

            'identitytype.required' => 'يجب عليك كتابة هذا الحقل',
            'identitytype.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'identitytype.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',

            'identitynumber.required' => 'يجب عليك كتابة هذا الحقل',
            'identitynumber.numeric' => 'يجب ان يكون هذا الحقل رقم',
            'identitynumber.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 20',

            'userimage.required' => 'يجب عليك كتابة هذا الحقل',

            'password.required' => 'يجب عليك كتابة كلمة السر',            
            'password.min' => ' الحد الادنى لكلمة السر هي 6 احرف',    

            'password_confirmation.same' => 'ليست متطابقة مع كلمة السر',            
            'password_confirmation.required_with' => 'ليست متطابقة مع كلمة السر',            
            'password_confirmation.min' => 'الحد الادنى لكلمة السر هي 6 احرف',            
        ];
    }
    public function deleteUser($id)
    {
        $user = User::find($id);
        if(!$user)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده']);
        
        $this->deleteFile($user->userimage,'images/users/');
        $user->delete();
        // if($user->user_type == 'مشرف')
        // {
        //     $user->supervisor()->delete();
        //     $user->delete();
        // }
        // else if($user->user_type == 'مدير تسويق' || 'مدير مبيعات')
        // {
        //     $user->manager()->delete();
        //     $user->delete();
        // }
        // else if($user->user_type == 'مندوب علمي' || 'مندوب مبيعات' || 'مدير فريق')
        // {
        //     $user->representatives()->delete();
        //     $user->delete();
        // }
        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
        // return redirect('/admin/displayAllUsers')->with('status','تم حذف البيانات بشكل ناجح');
    }
}
