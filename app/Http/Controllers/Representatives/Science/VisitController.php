<?php

namespace App\Http\Controllers\Representatives\Science;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Doctor;
use App\Models\OfferService;
use App\Models\ProblemsSolve;
use App\Models\Visit;
use App\Models\Service;
use App\Models\representative;
use App\Models\User;
use App\Models\SubArea;
use App\Models\VisitComposition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\userTrait;
class VisitController extends Controller
{
    use userTrait;
    public function getAllVisits()
    {
        $visits = Visit::where('representative_id',Auth::user()->representatives->id)->get();
        return view('representatives.repScience.manageVisits',compact('visits'));
    }
    public function addVisit()
    {
        $rep = Representative::findOrfail(Auth::user()->representatives->id);
        $customers = $rep->customers->where('statues',true);
        $doctors = $rep->doctors->where('statues',true);
        $items = $rep->items;
        $services = $rep->services;
        if($customers->count() < 1 && $doctors->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة زيارة، الرجاء اضافة على الاقل عميل او دكتور واحد!!! أو ان العملاء الذين اضفتهم لم يتم تفعيلهم']);
        return view('representatives.repScience.addVisit',compact('customers'))
        ->with('doctors',$doctors)->with('rep',$rep);
    }
    public function storeVisit(Request $request)
    {
        $doc_id=null;$cust_id=null;
        if($request->cust_type)
            $doc_id = $request->doctor_id;
        else
            $cust_id = $request->customer_id;
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $visit = Visit::create([
            'date' => $request->date,
            'type' => $request->type,
            'period' => $request->period,
            'result' => $request->result,
            'doctor_id' => $doc_id,
            'customer_id' => $cust_id,
            'representative_id' => Auth::user()->representatives->id,
        ]);
        if($request->type == 1){
            VisitComposition::create([
                'item' => $request->item,
                'scientific_mission' => $request->scientific_mission,
                'visit_id' => $visit->id,
            ]);
        }
        else if($request->type == 2){
            OfferService::create([
                'service_id' => $request->service_id,
                'visit_id' => $visit->id,
            ]);
        }
        else if($request->type == 2){
            ProblemsSolve::create([
                'description' => $request->description,
                'visit_id' => $visit->id,
            ]);
        }
        return redirect('/repScience/manageVisits')->with('status','تم إضافة البيانات بشكل ناجح');
    }
    protected function getRules()
    {
        return $rules = [
                'date' => 'required',
                'scientific_mission' => 'required|string|max:500',
                'result' => 'required|string|max:500',
                'description' => 'required|string|max:500',
                ];
    }
    protected function getMessages()
    {
        return $messages = [
            'date.required' => 'يجب عليك كتابة التأريخ',
            
            'scientific_mission.required' => 'يجب عليك كتابة هذا الحقل',
            'scientific_mission.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'scientific_mission.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 500',
            
            'result.required' => 'يجب عليك كتابة هذا الحقل',
            'result.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'result.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 500',
            
            'description.required' => 'يجب عليك كتابة هذا الحقل',
            'description.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'description.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 500',
        ];
    }
    public function editVisit($id)
    {
        $visit = Visit::find($id); 
        if($visit->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);

        $rep = Representative::findOrfail(Auth::user()->representatives->id);
        $customers = $rep->customers->where('statues',true);
        $doctors = Doctor::where('representative_id',Auth::user()->representatives->id)
        ->where('statues',true)->get();
        return view('representatives.repScience.editVisit', compact('visit'))
        ->with('doctors',$doctors)->with('customers',$customers);
    }
    public function updateVisit(Request $request,$id)
    {
        if($request->cust_type){
            $doc_id = $request->doctor_id;
            $cust_id = null;
        }
        else{
            $cust_id = $request->customer_id;
            $doc_id = null;
        }
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $visit = Visit::findOrfail($id);
        $visit->date = $request->date;
        $visit->type = $request->type;
        $visit->period = $request->period;
        $visit->result = $request->result;
        $visit->doctor_id = $doc_id;
        $visit->customer_id = $cust_id;
        $visit->representative_id = Auth::user()->representatives->id;
        $visit->update();
        if($request->type == 1){
            $composition = VisitComposition::findOrfail($visit->composition->id);
            $composition->item = $request->item;
            $composition->scientific_mission = $request->scientific_mission;
            $composition->visit_id = $visit->id;
            $composition->update();
        }
        else if($request->cust_type == 2){
            $offerService = OfferService::findOrfail($visit->composition->id);
            $offerService->service_id = $request->service_id;
            $offerService->visit_id = $visit->id;
            $offerService->update();
        }
        else if($request->cust_type == 2){
            $solveProblem = ProblemsSolve::findOrfail($visit->composition->id);
                $solveProblem->description = $request->description;
                $solveProblem->visit_id = $visit->id;
                $solveProblem->update();
        }

        return redirect('/repScience/manageVisits')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteVisit($id)
    {
        $visit = Visit::findOrfail($id);
        if($visit->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $visit->delete();

        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
        // return redirect('/repScience/manageVisits')->with('status','تم حذف البيانات بشكل ناجح');
    }
}
