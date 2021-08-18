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
        $mainareas = Mainarea::all();
        return view('managers.marketing.addSupervisor',compact('mainareas'));
    }
    public function storeSupervisor(Request $request)
    {
        $request->validate([
            'usernamethird' => 'required|string|max:255',
                'usersurname' => 'required|string|max:255',
                'sex' => 'required',
                'birthdate' => 'required|before:today',
                'birthplace' => 'required|string|max:255',
                'town' => 'required|string|max:255',
                'village' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'phonenumber' => 'required|numeric|max:999999999',
                'identitytype' => 'required|string|max:255',
                'identitynumber' => 'required|numeric',
                'userimage' => 'required',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required_with:password|same:password|min:6',
            ]);

        // $rules = $this->getRules();
        // $rules += ['userimage' => 'required'];
    //  = $this->getMessages();
        $validator = Validator::make($request->validated());
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->validated());
        }
        $file_name = '';
        if($request->hasfile('userimage'))
            $file_name = $this->saveImage($request->file('userimage'),'images/users/');
        else
            return redirect()->back()->with(['error' => 'يجب عليك تحميل الصورة']);
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
        $sup = Supervisor::create([
            'user_id' => $user->id,
            'manager_id' => Auth::user()->manager->id,
        ]);
        // if(sizeof($request->mainarea_ids) > 0)
        //     $sup->mainareas()->attach($request->mainarea_ids);
        // $validated = $request->validated();
        return redirect('/managerMarketing/manageSupervisors')->with('status','تم إضافة البيانات بشكل ناجح');
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

        //$user->update($request->validated());
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
