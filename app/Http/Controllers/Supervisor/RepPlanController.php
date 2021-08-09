<?php

namespace App\Http\Controllers\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\PlanType;
use App\Models\Representative;
use App\Models\Supervisor;
use App\Traits\userTrait;
use Illuminate\Support\Facades\Auth;

class RepPlanController extends Controller
{
    use userTrait;
    public function getRepsPlans()
    {
        $sup = Supervisor::findOrfail(Auth::user()->supervisor->id);
        $plans = $sup->plans;
        
        //to transform number month to txt month
        $plans = collect($plans);
        $plans = $plans->transform(function($value,$key){
            if($value['plan_month'] == 1)
                $value['plan_month'] = 'يناير';
            else if($value['plan_month'] == 2)
                $value['plan_month'] = 'فبراير';
            else if($value['plan_month'] == 3)
                $value['plan_month'] = 'مارس';
            else if($value['plan_month'] == 4)
                $value['plan_month'] = 'ابريل';
            else if($value['plan_month'] == 5)
                $value['plan_month'] = 'مايو';
            else if($value['plan_month'] == 6)
                $value['plan_month'] = 'يونيو';
            else if($value['plan_month'] == 7)
                $value['plan_month'] = 'يوليو';
            else if($value['plan_month'] == 8)
                $value['plan_month'] = 'أغسطس';
            else if($value['plan_month'] == 9)
                $value['plan_month'] = 'سبتمبر';
            else if($value['plan_month'] == 10)
                $value['plan_month'] = 'اكتوبر';
            else if($value['plan_month'] == 11)
                $value['plan_month'] = 'نوفمبر';
            else if($value['plan_month'] == 12)
                $value['plan_month'] = 'ديسمبر';
            
            return $value;
        });
        return view('supervisors.manageRepsPlans',compact('plans'));
    }
    public function addRepPlan()
    {
        $plan_types = PlanType::all();
        if($plan_types->count() < 1)
            return redirect()->back()->with(['error' => 'لم يتم اضافة نوع خطة، قم بإضافة على الأقل نوع واحد']);
        $reps = Representative::where('supervisor_id',Auth::user()->supervisor->id)->get();
        if($reps->count() < 1)
            return redirect()->back()->with(['error' => 'لم يتم اضافة مندوب، قم بإضافة على الأقل مندوب واحد']);
        return view('supervisors.addRepPlan',compact('plan_types'))->with('reps',$reps);
    }
    public function storeRepPlan(Request $request)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        Plan::create([
            'plan_month' => $request->plan_month,
            'plan_date' => $request->plan_date,
            'plan_status' => true,
            'plan_progress' => 0,
            'type_id' => $request->plan_type_id,
            'representative_id' => $request->rep_id,
        ]);
        return redirect('/supervisor/manageRepsPlans')->with('status','تم إضافة البيانات بشكل ناجح');
    }
    protected function getRules()
    {
        return $rules = [
                'plan_date' => 'required',
                ];
    }
    protected function getMessages()
    {
        return $messages = [
            'date.required' => 'يجب عليك كتابة التأريخ',
        ];
    }
    public function editRepPlan($id)
    {
        $plan = Plan::find($id); 
        $plan_types = PlanType::all();
        if($plan->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $reps = Representative::where('supervisor_id',Auth::user()->supervisor->id)->get();
        return view('supervisors.editRepPlan', compact('plan'))->with('plan_types',$plan_types)->with('reps',$reps);
    }   
    public function updateRepPlan(Request $request,$id)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $plan = Plan::find($id); 
        $plan->plan_month = $request->plan_month;
        $plan->plan_date = $request->plan_date;
        $plan->type_id = $request->plan_type_id;
        $plan->representative_id = $request->rep_id;
        $plan->update();
        return redirect('/supervisor/manageRepsPlans')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteRepPlan($id)
    {
        $plan = Plan::findOrfail($id);
        if($plan->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $plan->delete();
        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
    }
    public function activateRepPlan($id)
    {
        $plan = Plan::findOrfail($id);
        if($plan->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $plan->plan_status = true;
        $plan->update();
        ////////////////// Notify user //////////////////
        $user_id = $plan->represnetatives->user->id;
        $this->notifyUser('خطط','تم تفعيل الخطة',$user_id);
        return redirect('/supervisor/manageRepsPlans')->with('status','تم تفعيل الخطة');
    }
    public function notActivateRepPlan($id)
    {
        $plan = Plan::findOrfail($id);
        if($plan->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $plan->plan_status = false;
        $plan->update();
        ////////////////// Notify user //////////////////
        $user_id = $plan->represnetatives->user->id;
        $this->notifyUser('خطط','تم إالغاء تفعيل الخطة',$user_id);
        return redirect('/supervisor/manageRepsPlans')->with('status','تم إالغاء تفعيل الخطة');
    }
}
