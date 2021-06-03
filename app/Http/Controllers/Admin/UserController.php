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
                'supervisor_id' => $managerSales->id, //لأنه مندوب مبيعات فإن المشرف الذي يتبعه هو مدير المبيعات
            ]);
        }
        return redirect('/displayAllUsers')->with('status','تم إضافة البيانات بشكل ناجح');
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

        $user = User::find($id);

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
            $file_name = $this->saveImage($request->file('userimage'),'images/users/');
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
            $manager = Manager::get()->first();
            if(!$manager)
                return redirect()->back()->with(['error' => 'لايمكنك اضافة مشرف قبل مايتم اضافة مدير التسويق']);
            $sup = Supervisor::create(['user_id' => $user->id,'manager_id' => $manager->id]);
            $sup->update();
        }
        else if($request->Input('usertype') != 'مشرف' && $prevSupervisor) //delete supervisor becuase converted to another type
        {
            $supdelet = Supervisor::find($supervisorID);
            $supdelet->delete();
        }
        else if($request->Input('usertype') == 'مدير تسويق' || 'مدير مبيعات')
        {
            $manager = Manager::create(['user_id' => $user->id]);
        }
        else if($request->Input('usertype') == 'مندوب فريق' || 'مندوب علمي' || 'مندوب مبيعات')
        {
            $supervisor = Supervisor::get()->first();
            if(!$supervisor)
                return redirect()->back()->with(['error' => 'لايمكنك اضافة مشرف قبل مايتم اضافة مدير التسويق']);
            $manager = Manager::create(['user_id' => $user->id]);
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
                'phonenumber' => 'required|numeric|max:999999999',
                'identitytype' => 'required|string',
                'identitynumber' => 'required|numeric',
                'userimage' => 'required|max:255',
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
            // 'userimage.required' => 'يجب عليك تحميل الصورة',
            'password.required' => 'يجب عليك كتابة كلمة السر',

            'phonenumber.numeric' => 'يجب ان يكون هذا الحقل عدداً',
            'phonenumber.max' => 'يجب ان لا يتجاوز العدد لأكثر من 9 ارقام',
            'email.unique' => 'يوجد مستخدم اخر يستخدم هذا البريد الالكتروني',

            'usernamethird.string' => ' يجب كتابة الاسم الثلاثي بشكل نصي',
            'usersurname.string' => ' يجب كتابة اللقب بشكل نصي',

        ];
    }
    // public function deleteUser($id)
    // {
    //     return "kkk";
    //     $user = User::findOrFail($id);
    //     if(!$user)
    //             return redirect()->back();
    //     $supervisorID = 0;
    //     $sup = Supervisor::whereHas('user')->get();
    //     foreach($sup as $s)
    //     {
    //         if($s->user_id == $id)
    //         {
    //             $supervisorID = $s->id;
    //         }
    //     }
    //     $supDeleted = Supervisor::find($supervisorID);
    //     $mainarea = Mainarea::whereHas('supervisor')->get();
    //     $mainareaID = 0;
    //     foreach($mainarea as $s)
    //     {
    //         if($s->supervisor_id == $supDeleted->id)
    //         {
    //             $mainareaID = $s->id;
    //         }
    //     }

    //     if(!$user)
    //         return redirect()->back()->with(['error' => 'لا توجد بيانات لحذفها ']);
    //     else
    //     {
    //         $mainareaDeleted = Mainarea::find($mainareaID);
    //         $supDeleted->delete();
    //         $mainareaDeleted->delete();
    //         $user->delete();
    //         return redirect('/displayAllUsers')->with('status','تم حذف البيانات بشكل ناجح');
    //     }
    // }
    public function deleteUser($id)
    {
        $user = User::find($id);
        if(!$user)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده']);
        if($user->user_type == 'مشرف')
        {
            $user->supervisor()->delete();
            $user->delete();
        }
        else if($user->user_type == 'مدير تسويق' || 'مدير مبيعات')
        {
            $user->manager()->delete();
            $user->delete();
        }
        else if($user->user_type == 'مندوب علمي' || 'مندوب مبيعات' || 'مدير فريق')
        {
            $user->representatives()->delete();
            $user->delete();
        }
        return redirect('/displayAllUsers')->with('status','تم حذف البيانات بشكل ناجح');
    }
}
