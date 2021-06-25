<?php

namespace App\Http\Controllers\Admin;

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
    public function getAllRepresentatives()
    {
        $rep = Representative::with(['user','supervisor'])->get();
        return view('admin.manageRepresentatives', compact('rep',$rep));
    }
    public function addRepresentative()
    {
        $supervisor = Supervisor::with('user')->get();
        $subareas = SubArea::get();
        return view('admin.addRepresentative', compact('supervisor',$supervisor));
    }
    public function storeRepresentative(Request $request)
    {
        $usertype = $request->Input('usertype');
        $managerSales = User::where('user_type','مدير مبيعات')->first();
        if($usertype == 'مندوب مبيعات')
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

        // $rules = $this->getRules();
        // $messages = $this->getMessages();
        // $validator = Validator::make($request->all(),$rules,$messages);
        // if($validator->fails()){
        //     return redirect()->back()->withErrors($validator)->withInputs($request->all());
        // }

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
            Representative::create(
                [
                    // 'type' => $request->usertype,
                    'user_id' => $user->id,
                    'supervisor_id' => $request->supervisor_id,
                ]);
        return redirect('/admin/manageRepresentatives')->with('status','تم إضافة البيانات بشكل ناجح');
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
    public function editRepresentative($id)
    {
        $rep = Representative::findOrfail($id);
        $supervisor = Supervisor::get();
        return view('admin.editRepresentative',compact('supervisor',$supervisor))->with('rep',$rep );
    }
    public function updateRepresentative(Request $request,$id)
    {
        $user = User::find($id);
        if(!$user)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
            if($request->hasfile('userimage'))
            {
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

        $rep = Representative::find($request->rep_id);
        // $rep->type = $request->Input('usertype');
        $rep->supervisor_id = $request->Input('supervisor_id');
        $rep->update();
        
        return redirect('/admin/manageRepresentatives')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function showRepresentatives($id)
    {
        $subarea = Subarea::find($id);
        $rep = $subarea->mainarea->supervisor->representatives;
        return view('admin.representativesSubArea', compact('subarea',$subarea))->with('rep',$rep);
    }
    public function showMainareas($id)
    {
        $rep = Representative::with('user')->find($id);
        $mainareas = $rep->supervisor->mainareas;
        return view('admin.showMainareas',compact('mainareas',$mainareas))->with('rep',$rep);
    }
    public function storeRepMainArea(Request $request,$id)
    {
        $mainarea = Mainarea::find($request->main_area_id);
        $subareas = $mainarea->subareas;
        $mainarea->representative_id = $id;
        $mainarea->update();
        $rep = Representative::find($id);
        return view('admin.showSubareas',compact('subareas',$subareas))->with('rep',$rep);
    }
    public function storeRepSubareas(Request $request,$id)
    {
        $rep = Representative::find($id);
        if($rep->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $rep->subareas()->syncWithoutDetaching($request->subareasids);

        return redirect('/admin/manageRepresentatives')->with('status','تم اضافة المناطق للمندوب بشكل ناجح');
    }
}
