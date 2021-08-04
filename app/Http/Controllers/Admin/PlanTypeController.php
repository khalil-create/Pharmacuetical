<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\PlanType;

class PlanTypeController extends Controller
{
    public function getAllPlanTypes()
    {
        $planTypes = PlanType::all();
        return view('admin.managePlanTypes',compact('planTypes'));
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////
    public function addPlanType()
    {
        return view('admin.addPlanType');
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////
    public function storePlanType(Request $request)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        PlanType::create([
            'plan_type_name' => $request->plan_type_name,
        ]);
        return redirect('/admin/managePlanTypes')->with('status','تم إضافة البيانات بشكل ناجح');
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function getRules()
    {
        return $rules = [
                'plan_type_name' => 'required|string|max:255',
            ];
    }
    protected function getMessages()
    {
        return $messages = [
            'plan_type_name.required' => 'يجب عليك كتابة هذا الحقل',
            'plan_type_name.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'plan_type_name.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',
        ];
    }
    public function editPlanType($id)
    {
        $planType = PlanType::find($id);
        if($planType->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        return view('admin.editPlanType', compact('planType'));
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function UpdatePlanType(Request $request,$id)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $planType = PlanType::find($id);
        
        if($planType->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $planType->plan_type_name = $request->plan_type_name;
        $planType->update();
        return redirect('/admin/managePlanTypes')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deletePlanType($id)
    {
        $planType = PlanType::findOrfail($id);
        if($planType->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $planType->delete();
        return redirect('/admin/managePlanTypes')->with('status','تم حذف البيانات بشكل ناجح');
    }
}
