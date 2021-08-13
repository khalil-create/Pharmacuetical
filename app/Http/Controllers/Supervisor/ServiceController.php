<?php

namespace App\Http\Controllers\Supervisor;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\userTrait;
class ServiceController extends Controller
{
    use userTrait;
    public function getAllServices(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        $supervisor = Supervisor::findOrfail(Auth::user()->supervisor->id);
        return view('supervisors.manageServices',compact('supervisor'));
    }
    public function addService()
    {
        $supervisor = Supervisor::findOrfail(Auth::user()->supervisor->id);
        $reps = $supervisor->representatives;
        $customers = collect();
        foreach($reps as $rep){
            $customers = $customers->concat($rep->customers->where('statues',true));
        }
        $doctors = $supervisor->doctors->where('statues',true);
        if($customers->count() < 1 && $doctors->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة خدمة، الرجاء اضافة على الاقل عميل او دكتور واحد!!! أو ان العملاء لم يتم تفعيلهم']);
        return view('supervisors.addService',compact('customers'))->with('doctors',$doctors)->with('reps',$reps);
    }
    public function storeService(Request $request)
    {
        if($request->type == 0)
            $request->name = null;
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $service = Service::create([
            'type' => $request->type,
            'name' => $request->name,
            'cost' => $request->cost,
            'statues' => True,
            'representative_id' => $request->rep_id,
        ]);
        if($request->cust_type == 0)
            $service->customers()->attach($request->cust_ids);
        else if($request->cust_type == 1)
            $service->doctors()->attach($request->doctor_ids);
        return redirect('/supervisor/manageServices')->with('status','تم إضافة البيانات بشكل ناجح');
    }
    protected function getRules()
    {
        return $rules = [
                'name' => 'required|string|max:255',
                'cost' => 'required|numeric|max:1000000',
                ];
    }
    protected function getMessages()
    {
        return $messages = [
            'name.required' => 'يجب عليك كتابة هذا الحقل',
            'name.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'name.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',

            'cost.required' => 'يجب عليك كتابة هذا الحل',
            'cost.numeric' => 'يجب ان يكون هذا الحقل رقم',
            'cost.max' => 'مبلغ كبير جدا',
        ];
    }
    public function editService($id)
    {
        $service = Service::find($id); 
        if($service->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);

        $supervisor = Supervisor::findOrfail(Auth::user()->supervisor->id);
        $reps = $supervisor->representatives;
        $customers = collect();
        foreach($reps as $rep){
            $customers = $customers->concat($rep->customers->where('statues',true));
        }
        $doctors = $supervisor->doctors->where('statues',true);
        if($customers->count() < 1 && $doctors->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة خدمة، الرجاء اضافة على الاقل عميل او دكتور واحد!!! أو ان العملاء لم يتم تفعيلهم']);
        return view('supervisors.editService', compact('service'))->with('doctors',$doctors)
        ->with('customers',$customers)->with('reps',$reps);
    }
    public function updateService(Request $request,$id)
    {
        if($request->type == 0)
            $request->name = null;
        $service = Service::find($id);
        if($service->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $service->delete();
        $service = Service::create([
            'id' => $service->id,
            'type' => $request->type,
            'name' => $request->name,
            'cost' => $request->cost,
            'statues' => True,
            'representative_id' => $request->rep_id,
        ]);
        if($request->cust_type == 0)
            $service->customers()->attach($request->cust_ids);
        else if($request->cust_type == 1)
            $service->doctors()->attach($request->doctor_ids);
        return redirect('/supervisor/manageServices')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteService($id)
    {
        $Service = Service::findOrfail($id);
        if($Service->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $Service->delete();
        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
    }
    public function activateService($id)
    {
        $service = Service::findOrfail($id);
        if($service->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $service->statues = true;
        $service->update();
        ////////////////// Notify user //////////////////
        $user_id = $service->representative->user->id;
        $this->notifyUser('خدمات','تم قبول الخدمة',$user_id);
        return redirect('/supervisor/manageServices')->with('status','تم قبول الخدمة');
    }
    public function notActivateService($id)
    {
        $service = Service::findOrfail($id);
        if($service->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $service->statues = false;
        $service->update();
        ////////////////// Notify user //////////////////
        $user_id = $service->representatives->user->id;
        $this->notifyUser('خدمات','تم رفض الخدمة',$user_id);
        return redirect('/supervisor/manageServices')->with('status','تم إالغاء تفعيل الخدمة');
    }
    public function showServiceDetails($id)
    {
        $service = Service::with(['customers','doctors'])->findOrfail($id);
        if($service->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        return view('supervisors.showServiceDetails',compact('service'));
    }
}
