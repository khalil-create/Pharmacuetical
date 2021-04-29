<?php

namespace App\Http\Controllers\Admin;
use App\Models\Supervisor;
use App\Models\User;
use App\Models\Mainarea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\userTrait;

class SupervisorController extends Controller
{
    use userTrait;//for save images of users

    public function addSupervisor()
    {
        return view('admin.addSupervisor');
    }
    public function storeSupervisor(Request $request)
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
            $sup = Supervisor::create(['user_id' => $user->id]);
            $sup->update();

        return redirect('/manageSupervisors')->with('status','تم إضافة البيانات بشكل ناجح');
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
    public function getAllSupervisor()
    {
        $supervisor = User::whereHas('supervisor')->get();
        return view('admin.manageSupervisors', compact('supervisor',$supervisor));
       // return view('admin.manageSupervisors')->with('supervisor',$s);
        // foreach($s as $d)
        //     echo $d->id.' ';
        // $supervisors = \App\Models\Supervisor::with(['user' => function($q){
        //     $q->select('user_name_third','user_surname','user_image','email','sex','id');
        // }])->get();
        // return view('admin.manageSupervisors')->with('supervisor',\App\Models\Supervisor::with(['user' => function($q){
        //     $q->select('user_name_third','user_surname','user_image','email','sex','id');
        // }])->get());
        // $users = User::select('id','user_name_third','user_surname','user_type','sex','email','phone_number','user_image')->get();
        // return view('admin.accounts')->with('users',$users);
    }
    public function displayAllAreas($id)
    {
        return view('admin.manageSupervisors')->with('supervisor',\App\Models\MainArea::with(['mainareas' => function($q){
            $q->select('user_name_third','user_surname','user_image','email','sex','id');
        }])->get());
    }
    public function editSupervisor($id)
    {
        $user = User::findOrfail($id);
        return view('admin.editSupervisor')->with('user',$user );
    }
    public function updateSupervisor(Request $request,$id)
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
            // $file = $request->file('userimage');
            // $extention =$file->getClientOriginalExtension();
            // $filename = time().'.'.$extention;
            // $path = 'images/users/';
            // $file->move($path,$filename);
            $user->user_image = $file_name;

            
        }
        $user->update();
        
        // //$user->save();
        // if($request->Input('usertype') == 'مشرف' /* && request()->path() == 'userUpdate/'.$user->id */){
        //     // $sup = Supervisor::find($user->id);
        //     // // return $sup->user_id;
        //     // $sup->user_id = $user->id;            
        //     // $sup->update();
        //     $sup = Supervisor::create(['user_id' => $user->id]);
        //     $sup->update();
        // }
        // //global $id;
        // // $i = $id;
        // // $sup = User::whereHas('supervisor',function($q){
        // //     $q->where('user_id',$ii);
        // // })->get();
        // // return $i;
        
        // else{
        //     $supId = 0;
        //     $sup1 = Supervisor::get();
        //     foreach($sup1 as $sup){
        //         if($sup->user_id == $id)
        //             $supId = $sup->id;
        //     }
        //     $supdelet = Supervisor::find($supId);
        //     $supdelet->delete();
        // }
        // //return $sup;
        // // if($sup->user_id == $id){
        // //     $sup = Supervisor::findOrFail($id);
        // //     $sup->delete();
        // // }

        return redirect('/manageSupervisors')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteSupervisor($id)
    {
        $user = User::findOrFail($id);
        
        if(!$user)
            return redirect()->back()->with(['error' => 'لا توجد بيانات لحذفها ']);
        
        $user->delete();

        return redirect('/manageSupervisors')->with('status','تم حذف البيانات بشكل ناجح');        
    }
    public function getSupervisorAreas($id)
    {
        $sup = Supervisor::where('user_id',$id)->get();
        $supID = 0;
        foreach($sup as $s)
        {
            if($s->user_id == $id)
            {
                $supID = $s->id;
            }
        }
        // return $supID;
        if($supID != 0){
            $mainAreas = Mainarea::where('supervisor_id',$supID)->get();
            $supervisor = Supervisor::find($supID);
            $supName = $supervisor->user->user_name_third.' '.$supervisor->user->user_surname;
            return view('admin.mainAreaSupervised')->with('mainarea',$mainAreas)->with('exist',1)->with('supervisor_name',$supName);// exist = 1 that mean have at least one main area
        }
        else
            return view('admin.mainAreaSupervised')->with('exist',0);//supervisor but haven't main area
        
        
    }
}
