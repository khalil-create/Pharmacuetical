<?php

namespace App\Http\Controllers\Representatives\Science;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Doctor;
use App\Models\Plan;
use App\Models\PlansCustomer;
use App\Models\Representative;
use App\Models\PlanType;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class PlanCustController extends Controller
{
    public function planDetials($id)
    {
        $plan = Plan::with('customers_all')->findOrfail($id);
        $rep = Representative::findOrfail(Auth::user()->representatives->id);
        // $rep = Representative::with(['visits' => function($q){
        //     $q->select('representative_id','date','customer_id','doctor_id');
        // }])->findOrfail(Auth::user()->representatives->id);
        $customers = $rep->customers;
        $doctors = Doctor::where('representative_id',Auth::user()->representatives->id)->where('statues',1)->select('id','name')->get();

        // $visit = collect($rep->visits);
        // return $visit;
        // $visit = $visit->transform(function($value,$key){
        //     $date_arr = explode('-',$value['date']);
        //     // $date = $date_arr[1];
        //     $cust = $value['customer_id'];
        //     $doc = $value['doctor_id'];
        //     $visit['date'] = $date_arr;
        //     $visit['customer_id'] = $cust;
        //     $visit['doctor_id'] = $doc;
        //     return $visit;
        //     // return $value['month'] = $date[1];
        //     // return $value['date'];
        // })->toArray();
        // return $visit;
        return view('representatives.repScience.planDetials',compact('plan'))
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
        
        return redirect('/repScience/planDetials/'.$plan_id)->with('status','تم إضافة البيانات بشكل ناجح');
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
    public function editPlanCustomer($id)
    {
        $planCust = PlansCustomer::find($id);
        if($planCust->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $rep = Representative::findOrfail(Auth::user()->representatives->id);
        $customers = $rep->customers->where('statues',1);
        // $customers = Customer::where('representative_id',Auth::user()->representatives->id)->where('statues',1)->select('id','name')->get();
        $doctors = Doctor::where('representative_id',Auth::user()->representatives->id)->where('statues',1)->select('id','name')->get();

        return view('representatives.repScience.editPlanCustomer', compact('planCust'))
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
        return redirect('/repScience/planDetials/'.$planCust->plan_id)->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deletePlanCustomer($id)
    {
        $planCust = PlansCustomer::findOrfail($id);
        if($planCust->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $planCust->delete();

        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
        // return redirect('/repScience/planDetials/'.$planCust->plan_id)->with('status','تم حذف البيانات بشكل ناجح');
    }
}
