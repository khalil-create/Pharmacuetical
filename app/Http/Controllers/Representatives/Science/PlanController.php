<?php

namespace App\Http\Controllers\Representatives\Science;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\PlanType;
use Illuminate\Http\Request;
use App\Traits\userTrait;
use Illuminate\Support\Facades\Validator;
class PlanController extends Controller
{
    use userTrait;
    public function getAllPlans(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        $plans = Plan::where('representative_id',Auth::user()->representatives->id)->get();
        
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
        return view('representatives.repScience.managePlans',compact('plans'));
    }
    public function addPlan()
    {
        $plan_types = PlanType::all();
        if($plan_types->count() < 1)
            return redirect()->back()->with(['error' => 'لم يتم اضافة نوع خطة، اطلب من المشرف ان يضيف على الأقل نوع واحد']);
        return view('representatives.repScience.addPlan',compact('plan_types'));
    }
    public function storePlan(Request $request)
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
            'plan_status' => false,
            'plan_progress' => 0,
            'type_id' => $request->plan_type_id,
            'representative_id' => Auth::user()->representatives->id,
        ]);
        return redirect('/repScience/managePlans')->with('status','تم إضافة البيانات بشكل ناجح');
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
    public function editPlan($id)
    {
        $plan = Plan::find($id); 
        $plan_types = PlanType::all();
        if($plan->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);

        return view('representatives.repScience.editPlan', compact('plan'))->with('plan_types',$plan_types);
    }
    public function updatePlan(Request $request,$id)
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
        $plan->update();
        return redirect('/repScience/managePlans')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deletePlan($id)
    {
        $plan = Plan::findOrfail($id);
        if($plan->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $plan->delete();
        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
        // return redirect('/repScience/managePlans')->with('status','تم حذف البيانات بشكل ناجح');
    }
}
