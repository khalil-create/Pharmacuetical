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
        // $rep = User::where('user_type','مدير فريق')->get();

        $mainareas = Mainarea::all();
        // $subareas = Subarea::all();
        if($mainareas->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة مندوب مبيعات قبل مايتم اضافة على الاقل منطقة رئيسية واحدة']);
        
        return view('managers.sales.addRepresentative', compact('mainareas'));
    }
    public function storeRepresentative(Request $request)
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
            'user_type' => 'مندوب مبيعات',
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
        
        $rep = Representative::create(
            [
                'user_id' => $user->id,
                'mainarea_id' => $request->mainarea_id,
                'manager_id' => Auth::user()->manager->id,
            ]);
        
        // $rep->subareas()->syncWithoutDetaching($request->subareasIds);
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
                'phone_number' => 'numeric|required|max:999999999',
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

        $mainareas = Mainarea::all();
        // $subareas = Subarea::all();
        if($mainareas->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة مندوب مبيعات قبل مايتم اضافة على الاقل منطقة رئيسية واحدة']);
        
        return view('managers.sales.editRepresentative',compact('mainareas'))
        ->with('rep',$rep );
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
        $user->phone_number = $request->Input('phone_number');
        $user->identity_type = $request->Input('identitytype');
        $user->identity_number = $request->Input('identitynumber');
        $user->password = bcrypt($request->Input('password'));
        if($request->hasfile('userimage'))
            $user->user_image = $file_name;
        $user->update();

        // $rep->type = $request->Input('usertype');
        $rep = Representative::find($request->rep_id);
        $rep->manager_id = Auth::user()->manager->id;
        // $rep->teamleader_id = null;
        $rep->mainarea_id = $request->mainarea_id;
        $rep->update();
        
        // $rep->subareas()->syncWithoutDetaching($request->subareasIds);
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
        $subareas = Subarea::where('mainarea_id',$rep->mainarea_id)->get();
        if($subareas->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة مناطق فرعية لهذا المندوب ولا يملك منطقة رئيسية، يجب عليك اولاً اضافة منطقة رئيسية لهذا المندوب ']);
        return view('managers.sales.addRepSubareas',compact('subareas'))->with('rep',$rep);
    }
    public function storeRepSubareas(Request $request,$id)
    {
        $rep = Representative::find($id);
        // return $request->sub_area_ids;
        if($rep->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $rep->subareas()->sync($request->sub_area_ids);

        return redirect('/managerSales/showSubareas/'.$id)->with('status','تم اضافة المناطق للمندوب بشكل ناجح');
    }
    public function deleteRepresentative($id)
    {
        $rep = Representative::find($id);
        if($rep->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $user = User::findOrfail($rep->user_id);
        $user->delete();
        
        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
    }public function showRepDetails($id)
    {
        $rep = Representative::with(['customers','doctors','subareas'])->findOrfail($id);
        if($rep->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        return view('Managers.sales.showRepDetails',compact('rep'));   
    }
}
