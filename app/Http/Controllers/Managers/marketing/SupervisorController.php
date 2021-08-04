<?php

namespace App\Http\Controllers\Managers\marketing;
use Illuminate\Support\Facades\Auth;
use App\Models\Supervisor;
use App\Models\User;
use App\Models\Mainarea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Support\Facades\Validator;
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
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        if($request->hasfile('userimage'))
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
                'usertype' => 'required|string|max:255',
                'sex' => 'required|string|max:255',
                'birthdate' => 'required|string|max:255',
                'birthplace' => 'required|string|max:255',
                'town' => 'required|string|max:255',
                'village' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'phonenumber' => 'numeric|required|max:999999999',
                'identitytype' => 'required|string|max:255',
                'identitynumber' => 'required|numeric',
                'userimage' => 'required',
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
            // 'identitynumber.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 20',

            'userimage.required' => 'يجب عليك كتابة هذا الحقل',

            'password.required' => 'يجب عليك كتابة كلمة السر',            
            'password.min' => ' الحد الادنى لكلمة السر هي 6 احرف',    

            'password_confirmation.same' => 'ليست متطابقة مع كلمة السر',            
            'password_confirmation.required_with' => 'ليست متطابقة مع كلمة السر',            
            'password_confirmation.min' => 'الحد الادنى لكلمة السر هي 6 احرف',            
        ];
    }
    public function getAllSupervisor(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
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
        if(!$user)
            return redirect()->back()->with(['error' => 'لا توجد بيانات']);
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
            $this->deleteFile($user->userimage,'images/users/');
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

        $this->deleteFile($user->user_image,'images/users/');
        $comp = Company::where('supervisor_id',$user->supervisor->id)->get();
        foreach($comp as $c){
            $c->supervisor_id = null;
            $c->update();
        }
        $user->delete();

        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
        // return redirect('/managerMarketing/manageSupervisors')->with('status','تم حذف البيانات بشكل ناجح');        
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
