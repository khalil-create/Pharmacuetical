<?php

namespace App\Http\Controllers\Managers\marketing;
use Illuminate\Support\Facades\Auth;
use App\Models\Supervisor;
use App\Models\User;
use App\Models\Mainarea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Traits\userTrait;

class SupervisorController extends Controller
{
    use userTrait;//for save images of users

    public function addSupervisor()
    {
        return view('managers.marketing.addSupervisor');
    }
    public function storeSupervisor(Request $request)
    {
        $file_name = $this->saveImage($request->file('userimage'),'images/users/');
        
        $user = User::create([
            'user_name_third' => $request->usernamethird,
            'user_surname' => $request->usersurname,
            'user_type' => 'مشرف',
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
            Supervisor::create([
                'user_id' => $user->id,
                'manager_id' => Auth::user()->manager->id,
                ]);

        return redirect('/managerMarketing/manageSupervisors')->with('status','تم إضافة البيانات بشكل ناجح');
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
        return view('managers.marketing.manageSupervisors', compact('supervisor',$supervisor));
    }
    public function displayAllAreas($id)
    {
        return view('managers.marketing.manageSupervisors')->with('supervisor',\App\Models\MainArea::with(['mainareas' => function($q){
            $q->select('user_name_third','user_surname','user_image','email','sex','id');
        }])->get());
    }
    public function editSupervisor($id)
    {
        $user = User::findOrfail($id);
        return view('managers.marketing.editSupervisor')->with('user',$user );
    }
    public function updateSupervisor(Request $request,$id)
    {
        $user = User::find($id);
        if(!$user)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
                
        //$user->update($request->all());
        $user->user_name_third = $request->Input('usernamethird');
        $user->user_surname = $request->Input('usersurname');
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

        return redirect('/managerMarketing/manageSupervisors')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteSupervisor($id)
    {
        $user = User::findOrFail($id);
        
        if(!$user)
            return redirect()->back()->with(['error' => 'لا توجد بيانات لحذفها ']);
        
        $user->delete();

        return redirect('/managerMarketing/manageSupervisors')->with('status','تم حذف البيانات بشكل ناجح');        
    }
    public function getSupervisorAreas($id)
    {
        $sup = Supervisor::where('user_id',$id)->first();
        $supervisor = Supervisor::find($sup->id);
        
        if(!$supervisor)
            return redirect()->back()->with(['error' => 'لا توجد بيانات']);
        return view('managers.marketing.mainAreaSupervised',compact('supervisor',$supervisor));
    }
}
