<?php

namespace App\Http\Controllers\Managers\Sales;
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
        return view('managers.sales.home');
    }
    public function getAllRepresentatives(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        $rep = Representative::with('user')
        ->where('manager_id',Auth::user()->manager->id)->get();
        return view('managers.sales.manageRepresentatives', compact('rep',$rep));
    }
    public function addRepresentative()
    {
        $rep = User::where('user_type','مدير فريق')->get();

        $subareas = Subarea::all();
        if($subareas->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة مندوب مبيعات علمي قبل مايتم اضافة على الاقل منطقة فرعية واحدة']);
        
        return view('managers.sales.addRepresentative', compact('rep',$rep))
        ->with('subareas',$subareas);              
    }
    public function storeRepresentative(Request $request)
    {
        $users = User::select('email')->get();
        foreach($users as $user){
            if($user->email == $request->email)
                return redirect()->back()->with('error','هذا الايميل مستخدم لدى مستخدم اخر');
        }
        $rules = $this->getRules();
        $rules +=[
            'userimage' => 'required',];
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $file_name = null;
        if($request->hasfile('userimage'))
        {
            $file_name = $this->saveImage($request->file('userimage'),'images/users/');
        }

        $user = User::create([
            'user_name_third' => $request->usernamethird,
            'user_surname' => $request->usersurname,
            'user_type' => 'مندوب مبيعات',
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
        
        $rep = Representative::create(
            [
                'user_id' => $user->id,
                'manager_id' => Auth::user()->manager->id,
            ]);
        
        $rep->subareas()->syncWithoutDetaching($request->subareasIds);
        return redirect('/managerSales/manageRepresentatives')->with('status','تم إضافة البيانات بشكل ناجح');
    }
    protected function getRules()
    {
        return $rules = [
                'usernamethird' => 'required|string|max:255',
                'usersurname' => 'required|string|max:255',
                'birthdate' => 'required|max:255',
                'birthplace' => 'required|string|max:255',
                'town' => 'required|string|max:255',
                'village' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'phonenumber' => 'numeric|required|max:999999999',
                'identitytype' => 'required|string|max:255',
                'identitynumber' => 'required|numeric',
                // 'userimage' => 'required',
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
    public function editRepresentative($id)
    {
        $rep = Representative::findOrfail($id);

        $subareas = Subarea::all();
        if($subareas->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة مندوب مبيعات علمي قبل مايتم اضافة على الاقل منطقة فرعية واحدة']);
        
        return view('managers.sales.editRepresentative',compact('subareas'))
        ->with('rep',$rep );
    }
    public function updateRepresentative(Request $request,$id)
    {
        $user = User::find($id);
        if(!$user)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $users = User::select('id','email')->get();
        foreach($users as $u){
            if($u->email == $request->email && $id != $u->id)
                return redirect()->back()->with('error','هذا الايميل مستخدم لدى مستخدم اخر');
        }
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        // return $user;
        if($request->hasfile('userimage'))
        {
            $this->deleteFile($user->user_image,'images/users/');
            $file_name = $this->saveImage($request->file('userimage'),'images/users/');
        }

        //$user->update($request->all());
        $user->user_name_third = $request->Input('usernamethird');
        $user->user_surname = $request->Input('usersurname');
        $user->user_type = 'مندوب مبيعات';
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
        return redirect('/managerSales/manageRepresentatives')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function showSubareas($id)
    {
        $rep = Representative::with('user')->find($id);
        $subareas = $rep->subareas;
        return view('managers.sales.showSubareas',compact('subareas'))->with('rep',$rep);
    }
    public function addRepSubareas($id)
    {
        $rep = Representative::with('user')->find($id);
        $subareas = Subarea::all();
        return view('managers.sales.addRepSubareas',compact('subareas'))->with('rep',$rep);
    }
    public function storeRepSubareas(Request $request,$id)
    {
        $rep = Representative::find($id);
        // return $request->sub_area_ids;
        if($rep->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $rep->subareas()->syncWithoutDetaching($request->sub_area_ids);

        return redirect('/managerSales/showSubareas/'.$id)->with('stat    us','تم اضافة المناطق للمندوب بشكل ناجح');
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
}
