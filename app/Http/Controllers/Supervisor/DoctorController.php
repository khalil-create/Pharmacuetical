<?php

namespace App\Http\Controllers\Supervisor;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Representative;
use App\Models\Specialist;
use App\Models\Supervisor;
use App\Models\User;
use App\Models\SubArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\userTrait;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    use userTrait;
    public function getAllDoctors(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        $supervisor = Supervisor::find(Auth::user()->supervisor->id);
        return view('supervisors.manageDoctors',compact('supervisor'));
    }
    public function addDoctor()
    {
        $reps = Representative::where('supervisor_id',Auth::user()->supervisor->id)->get();
        if($reps->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة عميل ولم يتم اضافة على الاقل مندوب واحد']);
        
        $specialists = Specialist::all();
        return view('supervisors.addDoctor')->with('reps',$reps)->with('specialists',$specialists);
    }
    public function storeDoctor(Request $request)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $doctor = Doctor::create([
            'name' => $request->name,
            'mobile_phone' => $request->mobile_phone,
            'clinic_phone' => $request->clinic_phone,
            'workplace_am' => $request->workplace_am,
            'workplace_pm' => $request->workplace_pm,
            'rank' => $request->rank,
            'loyalty' => $request->loyalty,
            'address' => $request->address,
            'statues' => True,
            'representative_id' => $request->rep_id,
        ]);
        $doctor->specialists()->attach($request->specialist_ids);
        return redirect('/supervisor/manageDoctors')->with('status','تم إضافة البيانات بشكل ناجح');
    }
    protected function getRules()
    {
        return $rules = [
                'name' => 'required|string|max:255',
                'mobile_phone' => 'required|numeric|max:799999999',
                'clinic_phone' => 'required|numeric|max:99999999',
                'workplace_am' => 'required|string|max:255',
                'workplace_pm' => 'required|string|max:255',
                'rank' => 'required|string|max:255',
                'address' => 'required|string|max:255',
            ];
    }
    protected function getMessages()
    {
        return $messages = [
            'name.required' => 'يجب عليك كتابة هذا الحقل',
            'name.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'name.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',

            'mobile_phone.required' => 'يجب عليك كتابة رقم الهاتف',
            'mobile_phone.numeric' => 'يجب ان يكون هذا الحقل رقم',
            'mobile_phone.max' => 'يجب ان لايتجاوز عدد الارقام اكثر من 9',

            'clinic_phone.required' => 'يجب عليك كتابة رقم العيادة',
            'clinic_phone.numeric' => 'يجب ان يكون هذا الحقل رقم',
            'clinic_phone.max' => 'يجب ان لايتجاوز عدد الارقام اكثر من 8',

            'workplace_am.required' => 'يجب عليك كتابة هذا الحقل',
            'workplace_am.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'workplace_am.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',

            'workplace_pm.required' => 'يجب عليك كتابة هذا الحقل',
            'workplace_pm.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'workplace_pm.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',

            'rank.required' => 'يجب عليك كتابة هذا الحقل',
            'rank.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'rank.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',

            'address.required' => 'يجب عليك كتابة هذا الحقل',
            'address.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'address.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',
        ];
    }
    public function editDoctor($id)
    {
        $doctor = Doctor::find($id); 
        if($doctor->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $reps = Representative::where('supervisor_id',Auth::user()->supervisor->id)->get();
        $specialists = Specialist::all();
        return view('supervisors.editDoctor', compact('doctor'))->with('reps',$reps)->with('specialists',$specialists);
    }
    public function updateDoctor(Request $request,$id)
    {
        $doctor = Doctor::find($id);
        if($doctor->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $doctor->name = $request->name;
        $doctor->mobile_phone = $request->mobile_phone;
        $doctor->clinic_phone = $request->clinic_phone;
        $doctor->workplace_am = $request->workplace_am;
        $doctor->workplace_pm = $request->workplace_pm;
        $doctor->rank = $request->rank;
        $doctor->loyalty = $request->loyalty;
        $doctor->address = $request->address;
        $doctor->representative_id = $request->rep_id;
        $doctor->update();
        $doctor->specialists()->attach($request->specialist_ids);
        return redirect('/supervisor/manageDoctors')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteDoctor($id)
    {
        $doctor = Doctor::findOrfail($id);
        if($doctor->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $doctor->delete();

        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
        // return redirect('/supervisor/manageDoctors')->with('status','تم حذف البيانات بشكل ناجح');
    }
    public function activateDoctor($id)
    {
        $doctor = Doctor::findOrfail($id);
        if($doctor->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $doctor->statues = true;
        $doctor->update();
        ///////////////// Notify user //////////////////////
        $user_id = $doctor->representative->user->id;
        $this->notifyUser('اطباء','تم تفعيل الطبيب',$user_id);
        return redirect('/supervisor/manageDoctors')->with('status','تم تفعيل الطبيب');
    }
    public function notActivateDoctor($id)
    {
        $doctor = Doctor::findOrfail($id);
        if($doctor->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $doctor->statues = false;
        $doctor->update();
        ///////////////// Notify user //////////////////////
        $user_id = $doctor->representative->user->id;
        $this->notifyUser('اطباء','تم إالغاء تفعيل الطبيب',$user_id);
        return redirect('/supervisor/manageDoctors')->with('status','تم إالغاء تفعيل الدكتور');
    }
    public function showDoctorDetails($id)
    {
        $doctor = Doctor::with(['specialists','services'])->findOrfail($id);
        if($doctor->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        return view('supervisors.showDoctorDetails',compact('doctor'));
    }
}
