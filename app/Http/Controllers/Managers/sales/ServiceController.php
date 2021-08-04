<?php

namespace App\Http\Controllers\Managers\Sales;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\Service;
use App\Models\Representative;
use App\Models\Customer;
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
        $manager = Manager::findOrfail(Auth::user()->manager->id);
        $services = $manager->services;
        return view('managers.sales.manageServices',compact('services'));
    }
    public function addService()
    {
        $reps = Representative::where('manager_id',Auth::user()->manager->id)->get();
        // return $reps;
        $customers = collect();
        foreach($reps as $rep){
            $customers = $customers->concat($rep->customers);
        }
        // return $customers;
        $customers = $customers->where('statues',true);
        if($customers->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة خدمة، الرجاء اضافة على الاقل عميل واحد!!! أو ان العملاء الذين اضفتهم لم يتم تفعيلهم']);
        return view('managers.sales.addService',compact('customers'))->with('reps',$reps);
    }
    public function storeService(Request $request)
    {
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
            'statues' => true,
            'representative_id' => $request->rep_id,
        ]);
            $service->customers()->attach($request->cust_ids);
        return redirect('/managerSales/manageServices')->with('status','تم إضافة البيانات بشكل ناجح');
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

        $reps = Representative::where('manager_id',Auth::user()->manager->id)->get();
        $customers = collect();
        foreach($reps as $rep){
            $customers = $customers->concat($rep->customers);
        }
        $customers = $customers->where('statues',true);
        if($customers->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة خدمة، الرجاء اضافة على الاقل عميل واحد!!! أو ان العملاء الذين اضفتهم لم يتم تفعيلهم']);
        return view('managers.sales.editService', compact('service'))
        ->with('reps',$reps)->with('customers',$customers);
    }
    public function updateService(Request $request,$id)
    {
        $service = Service::find($id);
        if($service->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $service->type = $request->type;
        $service->name = $request->name;
        $service->cost = $request->cost;
        $service->representative_id = $request->rep_id;

        $service->customers()->sync($request->cust_ids);        
        $service->update();
        return redirect('/managerSales/manageServices')->with('status','تم تعديل البيانات بشكل ناجح');
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
        return redirect('/managerSales/manageServices')->with('status','تم تفعيل الخدمة');
    }
    public function notActivateService($id)
    {
        $service = Service::findOrfail($id);
        if($service->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $service->statues = false;
        $service->update();
        ////////////////// Notify user //////////////////
        $user_id = $service->representative->user->id;
        $this->notifyUser('خدمات','تم رفض الخدمة',$user_id);
        return redirect('/managerSales/manageServices')->with('status','تم إالغاء تفعيل الخدمة');
    }
    public function deleteService($id)
    {
        $Service = Service::findOrfail($id);
        if($Service->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $Service->delete();

        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
    }
}
