<?php

namespace App\Http\Controllers\Supervisor;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Mainarea;
use App\Models\Representative;
use App\Models\Supervisor;
use App\Models\User;
use App\Models\SubArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\userTrait;

class RepresentativeController extends Controller
{
    use userTrait;//for save images of users
    public function home()
    {
        return view('supervisors.home');
    }
    public function getAllRepresentatives()
    {
        $rep = Representative::with(['user','supervisor'])
        ->where('supervisor_id',Auth::user()->supervisor->id)->get();
        return view('supervisors.manageRepresentatives', compact('rep',$rep));
    }
    public function addRepresentative()
    {
        $rep = User::where('user_type','مدير فريق')->get();

        $sup = Supervisor::find(Auth::user()->supervisor->id);
        $subareas = $sup->subareas;
        if($subareas->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة مندوب مبيعات علمي قبل مايتم اضافة على الاقل منطقة فرعية واحدة']);
        
        $isExistTeamLeader = true;
        $teamLeader = User::where('user_type','مدير فريق')->get();
        if($teamLeader->count() < 1)
            $isExistTeamLeader = false;
        return view('supervisors.addRepresentative', compact('rep',$rep))
        ->with('subareas',$subareas)->with('isExistTeamLeader',$isExistTeamLeader);              
    }
    public function storeRepresentative(Request $request)
    {
        $usertype = $request->Input('usertype');
        if($usertype == 'مدير فريق')
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

        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }

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
        $rep = null;
        if($user->user_type == 'مدير فريق'){
            $rep = Representative::create(
                [
                    'user_id' => $user->id,
                    'supervisor_id' => Auth::user()->supervisor->id,
                ]);
        }
        else if($user->user_type == 'مندوب علمي'){
            $rep = Representative::create(
                [
                    'user_id' => $user->id,
                    'supervisor_id' => Auth::user()->supervisor->id,
                    'teemleader_id' => $request->teemleader_id,
                ]);
        }
        $rep->subareas()->syncWithoutDetaching($request->subareasIds);
        return redirect('/supervisor/manageRepresentatives')->with('status','تم إضافة البيانات بشكل ناجح');
    }
    protected function getRules()
    {
        return $rules = [
                'usernamethird' => 'required|string|max:255',
                'usersurname' => 'required|string|max:255',
                'type' => 'string|max:255',
                'sex' => 'required|string|max:255',
                'birthdate' => 'required|string|max:255',
                'birthplace' => 'required|string|max:255',
                'town' => 'required|string|max:255',
                'village' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'phonenumber' => 'max:999999999|numeric|required',
                'identitytype' => 'required|string',
                'identitynumber' => 'required|numeric',
                'userimage' => 'required',
                'password' => 'required|string|min:6|confirmed',
                'subareasIds' => 'required',
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
            'subareasIds.required' => 'يجب عليك اختيار منطقة',
            'password.required' => 'يجب عليك كتابة كلمة السر',

            'phonenumber.numeric' => 'يجب ان يكون رقم',
            'phonenumber.max' => 'لايمكن تجاوز رقم الهاتف الى اكثر من 9 ارقام',

            'usernamethird.string' => ' يجب كتابة الاسم الثلاثي بشكل نصي',
            'usersurname.string' => ' يجب كتابة اللقب بشكل نصي',
            
        ];
    }
    public function editRepresentative($id)
    {
        $rep = Representative::findOrfail($id);
        $rep2 = User::where('user_type','مدير فريق')->get();

        $sup = Supervisor::find(Auth::user()->supervisor->id);
        $subareas = $sup->subareas;//hasManyThrough relation
        if($subareas->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة مندوب مبيعات علمي قبل مايتم اضافة على الاقل منطقة فرعية واحدة']);
        
        $isExistTeamLeader = true;
        $teamLeader = User::where('user_type','مدير فريق')->get();
        if($teamLeader->count() < 1)
            $isExistTeamLeader = false;

        return view('supervisors.editRepresentative',compact('teamLeader',$teamLeader))
        ->with('rep',$rep )->with('subareas',$subareas)->with('rep2',$rep2);
    }
    public function updateRepresentative(Request $request,$id)
    {
        $user = User::find($id);
        if(!$user)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
            if($request->hasfile('userimage'))
            {
                $this->deleteFile($user->userimage,'images/users/');
                $file_name = $this->saveImage($request->file('userimage'),'images/users/');
            }

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
            $user->user_image = $file_name;
        $user->update();

        // $rep->type = $request->Input('usertype');
        $rep = Representative::find($request->rep_id);
        if($user->user_type == 'مدير فريق'){
            $rep->supervisor_id = Auth::user()->supervisor->id;
            $rep->teamleader_id = null;
            $rep->update();
        }
        else if($user->user_type == 'مندوب علمي'){
            $rep->teemleader_id = $request->teemleader_id;
        }
        $rep->subareas()->syncWithoutDetaching($request->subareasIds);
        return redirect('/supervisor/manageRepresentatives')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function showRepresentatives($id)
    {
        $subarea = Subarea::find($id);
        $rep = $subarea->mainarea->supervisor->representatives;
        return view('supervisors.representativesSubArea', compact('subarea',$subarea))->with('rep',$rep);
    }
    public function showMainareas($id)
    {
        $rep = Representative::with('user')->find($id);
        $mainareas = $rep->supervisor->mainareas;
        return view('supervisors.showMainareas',compact('mainareas',$mainareas))->with('rep',$rep);
    }
    public function storeRepMainArea(Request $request,$id)
    {
        $mainarea = Mainarea::find($request->main_area_id);
        $subareas = $mainarea->subareas;
        $mainarea->representative_id = $id;
        $mainarea->update();
        $rep = Representative::find($id);
        return view('supervisors.showSubareas',compact('subareas',$subareas))->with('rep',$rep);
    }
    public function storeRepSubareas(Request $request,$id)
    {
        $rep = Representative::find($id);
        if($rep->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $rep->subareas()->syncWithoutDetaching($request->subareasids);

        return redirect('/supervisor/manageRepresentatives')->with('status','تم اضافة المناطق للمندوب بشكل ناجح');
    }
}
