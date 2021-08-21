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
    public function getAllRepresentatives(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        $rep = Representative::with(['user','supervisor'])
        ->where('supervisor_id',Auth::user()->supervisor->id)->get();
        return view('supervisors.manageRepresentatives', compact('rep',$rep));
    }
    public function addRepresentative()
    {
        $rep = User::where('user_type','مدير فريق')->get();

        $sup = Supervisor::find(Auth::user()->supervisor->id);
        $mainareas = $sup->mainareas;
        // $subareas = $sup->subareas;
        if($mainareas->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة مندوب علمي قبل مايتم اضافة على الاقل منطقة رئيسية واحدة']);
        
        $isExistTeamLeader = true;
        $teamLeader = User::where('user_type','مدير فريق')->get();
        if($teamLeader->count() < 1)
            $isExistTeamLeader = false;
        return view('supervisors.addRepresentative', compact('rep',$rep))
        ->with('mainareas',$mainareas)->with('isExistTeamLeader',$isExistTeamLeader);              
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

        $request->validate([
            'usernamethird' => 'required|string|max:255',
            'usersurname' => 'required|string|max:255',
            'sex' => 'required',
            'birthdate' => 'required|before:today',
            'birthplace' => 'required|string|max:255',
            'town' => 'required|string|max:255',
            'village' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|numeric|max:999999999|min:700000000|unique:users',
            'identitytype' => 'required|string|max:255',
            'identitynumber' => 'required|numeric',
            'userimage' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required_with:password|same:password|min:6',
        ]);
        
        $file_name = null;
        if($request->hasfile('userimage'))
        {
            $file_name = $this->saveImage($request->file('userimage'),'images/users/');
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
            'phone_number' => $request->phone_number,
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
                    'mainarea_id' => $request->mainarea_id,
                    'supervisor_id' => Auth::user()->supervisor->id,
                ]);
        }
        else if($user->user_type == 'مندوب علمي'){
            $rep = Representative::create(
                [
                    'user_id' => $user->id,
                    'mainarea_id' => $request->mainarea_id,
                    'supervisor_id' => Auth::user()->supervisor->id,
                    'teamleader_id' => $request->teamleader_id,
                ]);
        }
        // $rep->subareas()->syncWithoutDetaching($request->subareasIds);
        return redirect('/supervisor/manageRepresentatives')->with('status','تم إضافة البيانات بشكل ناجح');
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
                // 'email' => 'required|string|email|max:255',
                // 'phone_number' => 'numeric|required|max:999999999',
                'identitytype' => 'required|string|max:255',
                'identitynumber' => 'required|numeric',
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

            'phone_number.required' => 'يجب عليك كتابة هذا الحقل',
            'phone_number.numeric' => 'يجب ان يكون هذا الحقل رقم',
            'phone_number.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 9',
            'phone_number.unique' => 'هذا الرقم بالفعل مسجل على حساب اخر.. تأكد من الرقم',

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
    public function editRepresentative($id)
    {
        $rep = Representative::findOrfail($id);
        $rep2 = User::where('user_type','مدير فريق')->get();

        $sup = Supervisor::find(Auth::user()->supervisor->id);
        $mainareas = $sup->mainareas;//hasManyThrough relation
        // $subareas = $sup->subareas;//hasManyThrough relation
        if($mainareas->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة مندوب علمي قبل مايتم اضافة على الاقل منطقة رئيسية واحدة']);
        
        $isExistTeamLeader = true;
        $teamLeader = User::where('user_type','مدير فريق')->get();
        if($teamLeader->count() < 1)
            $isExistTeamLeader = false;

        return view('supervisors.editRepresentative',compact('teamLeader',$teamLeader))
        ->with('rep',$rep )->with('mainareas',$mainareas)->with('rep2',$rep2);
    }
    public function updateRepresentative(Request $request,$id)
    {
        $user = User::find($id);
        if(!$user)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $request->validate([
            'usernamethird' => 'required|string|max:255',
            'usersurname' => 'required|string|max:255',
            'sex' => 'required',
            'birthdate' => 'required|before:today',
            'birthplace' => 'required|string|max:255',
            'town' => 'required|string|max:255',
            'village' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email'.($id ? ",$id" : ''),
            'phone_number' => 'required|numeric|max:999999999|min:700000000|unique:users,phone_number'.($id ? ",$id" : ''),
            'identitytype' => 'required|string|max:255',
            'identitynumber' => 'required|numeric',
            // 'userimage' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required_with:password|same:password|min:6',
        ]);
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
        $user->phone_number = $request->Input('phone_number');
        $user->identity_type = $request->Input('identitytype');
        $user->identity_number = $request->Input('identitynumber');
        $user->password = bcrypt($request->Input('password'));
        if($request->hasfile('userimage'))
            $user->user_image = $file_name;
        $user->update();

        // $rep->type = $request->Input('usertype');
        $rep = Representative::find($request->rep_id);
        $rep->mainarea_id = $request->mainarea_id;
        if($user->user_type == 'مدير فريق'){
            $rep->supervisor_id = Auth::user()->supervisor->id;
            $rep->teamleader_id = null;
        }
        elseif($user->user_type == 'مندوب علمي'){
            $rep->teamleader_id = $request->teamleader_id;
        }
        $rep->update();
        // $rep->subareas()->syncWithoutDetaching($request->subareasIds);
        return redirect('/supervisor/manageRepresentatives')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function showSubareas($id)
    {
        $rep = Representative::with('user')->find($id);
        $subareas = $rep->subareas;
        return view('supervisors.showSubareas',compact('subareas'))->with('rep',$rep);
    }
    public function addRepSubareas($id)
    {
        $rep = Representative::with('user')->find($id);
        $sup = Supervisor::find(Auth::user()->supervisor->id);
        $subareas = Subarea::where('mainarea_id',$rep->mainarea_id)->get();
        if($subareas->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة مناطق فرعية لهذا المندوب ولا يملك منطقة رئيسية، يجب عليك اولاً اضافة منطقة رئيسية لهذا المندوب ']);
        return view('supervisors.addRepSubareas',compact('subareas'))->with('rep',$rep);
    }
    // public function storeRepMainArea(Request $request,$id)
    // {
    //     $mainarea = Mainarea::find($request->main_area_id);
    //     $subareas = $mainarea->subareas;
    //     $mainarea->representative_id = $id;
    //     $mainarea->update();
    //     $rep = Representative::find($id);
    //     return view('supervisors.showSubareas',compact('subareas',$subareas))->with('rep',$rep);
    // }
    public function storeRepSubareas(Request $request,$id)
    {
        $rules = ['sub_area_ids' => 'required'];
        $messages = ['sub_area_ids.required' => 'يجب ان تختار على الاقل منطقة واحدة'];
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $rep = Representative::find($id);
        if($rep->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $rep->subareas()->sync($request->sub_area_ids);

        return redirect('/supervisor/showSubareas/'.$id)->with('stat    us','تم اضافة المناطق للمندوب بشكل ناجح');
    }
    public function deleteRepresentative($id)
    {
        $rep = Representative::find($id);
        if($rep->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $user = User::findOrfail($rep->user_id);
        $user->delete();
        
        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
    }
    public function showRepDetails($id)
    {
        $rep = Representative::with(['customers','doctors','subareas'])->findOrfail($id);
        if($rep->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        return view('supervisors.showRepDetails',compact('rep'));   
    }
}
