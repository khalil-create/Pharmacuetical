<?php

namespace App\Http\Controllers\Supervisor;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Doctor;
use App\Models\Plan;
use App\Models\PlansCustomer;
use App\Models\Representative;
use App\Models\PlanType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class PlanCustController extends Controller
{
    public function planDetials($id)
    {
        $plan = Plan::with('customers_all')->findOrfail($id);
        $rep = Representative::findOrfail($plan->representative_id);
        $customers = $rep->customers;
        $doctors = Doctor::where('representative_id',$plan->representative_id)->where('statues',1)->select('id','name')->get();

        return view('supervisors.planDetials',compact('plan'))
        ->with('customers',$customers)->with('doctors',$doctors);
    }
    public function storePlanCustomer(Request $request,$plan_id)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $name = $request->customer_name;
        $cust = Customer::where('name',$name)->first();
        if($cust)
        {
            PlansCustomer::create([
                'visit_date' => $request->date,
                'period' => $request->period,
                'note' => $request->note,
                'customer_id' => $cust->id,
                'plan_id' => $plan_id,
            ]);
        }
        else
        {
            $doctor = Doctor::where('name',$name)->first();
            PlansCustomer::create([
                'visit_date' => $request->date,
                'period' => $request->period,
                'note' => $request->note,
                'doctor_id' => $doctor->id,
                'plan_id' => $plan_id,
            ]);
        }
        
        return redirect('/supervisor/planDetials/'.$plan_id)->with('status','تم إضافة البيانات بشكل ناجح');
    }
    protected function getRules()
    {
        return $rules = [
                'date' => 'required',
                ];
    }
    protected function getMessages()
    {
        return $messages = [
            'date.required' => 'يجب عليك كتابة التأريخ',
        ];
    }
    public function editPlanCustomer(Request $request)
    {
        $plan_id = $request->get('plan_id');
        $rep_id = $request->get('rep_id');
        $planCust = PlansCustomer::find($plan_id);
        $rep = Representative::findOrfail($rep_id);
        if($planCust->count() < 1 || $rep->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);

        $customers = $rep->customers->where('statues',1);
        $doctors = Doctor::where('representative_id',$rep_id)->where('statues',1)->select('id','name')->get();

        return view('supervisors.editPlanCustomer', compact('planCust'))
        ->with('customers',$customers)->with('doctors',$doctors);
    }
    public function updatePlanCustomer(Request $request,$id)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $planCust = PlansCustomer::find($id);
        $planCust->visit_date = $request->date;
        $planCust->period = $request->period;
        $planCust->note = $request->note;

        $name = $request->customer_name;
        $cust = Customer::where('name',$name)->first();
        $doc = Doctor::where('name',$name)->first();
        if($cust)
            $planCust->customer_id = $cust->id;
        else
            $planCust->doctor_id = $doc->id;
        $planCust->update();
        return redirect('/supervisor/planDetials/'.$planCust->plan_id)->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deletePlanCustomer($id)
    {
        $planCust = PlansCustomer::findOrfail($id);
        if($planCust->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $planCust->delete();

        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
        // return redirect('/supervisor/planDetials/'.$planCust->plan_id)->with('status','تم حذف البيانات بشكل ناجح');
    }
}
