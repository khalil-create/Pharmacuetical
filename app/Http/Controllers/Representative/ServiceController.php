<?php

namespace App\Http\Controllers\Representative;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\representative;
use App\Models\User;
use App\Models\SubArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\userTrait;
class ServiceController extends Controller
{
    use userTrait;
    public function getAllServices()
    {
        $services = Service::where('representative_id',Auth::user()->representatives->id)->get();
        return view('representatives.repScience.manageServices',compact('services'));
    }
    public function addService()
    {
        $customers = Customer::where('representative_id',Auth::user()->representatives->id)
        ->where('statues',true)->get();
        $doctors = Doctor::where('representative_id',Auth::user()->representatives->id)
        ->where('statues',true)->get();
        if($customers->count() < 1 && $doctors->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة خدمة، الرجاء اضافة على الاقل عميل او دكتور واحد!!! أو ان العملاء الذين اضفتهم لم يتم تفعيلهم']);
        return view('representatives.repScience.addService',compact('customers'))->with('doctors',$doctors);
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
            'statues' => False,
            'representative_id' => Auth::user()->representatives->id,
        ]);
        if($request->cust_type == 0)
            $service->customers()->attach($request->cust_ids);
        else if($request->cust_type == 1)
            $service->doctors()->attach($request->doctor_ids);
        return redirect('/representative/manageServices')->with('status','تم إضافة البيانات بشكل ناجح');
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

        $customers = Customer::where('representative_id',Auth::user()->representatives->id)
        ->where('statues',true)->get();
        $doctors = Doctor::where('representative_id',Auth::user()->representatives->id)
        ->where('statues',true)->get();
        return view('representatives.repScience.editService', compact('service'))
        ->with('doctors',$doctors)->with('customers',$customers);
    }
    public function updateService(Request $request,$id)
    {
        if($request->type == 0)
            $request->name = null;
        $service = Service::find($id);
        if($service->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $service->type = $request->type;
        $service->name = $request->name;
        $service->cost = $request->cost;

        if($request->cust_type == 0)
            $service->customers()->sync($request->cust_ids);
        else if($request->cust_type == 1)
            $service->doctors()->sync($request->doctor_ids);
        
        $service->update();

        return redirect('/representative/manageServices')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteService($id)
    {
        $Service = Service::findOrfail($id);
        if($Service->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $Service->delete();

        return redirect('/representative/manageServices')->with('status','تم حذف البيانات بشكل ناجح');
    }
}
