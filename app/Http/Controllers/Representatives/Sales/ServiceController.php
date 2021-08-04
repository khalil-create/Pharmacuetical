<?php

namespace App\Http\Controllers\Representatives\Sales;
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
    public function getAllServices(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        $services = Service::where('representative_id',Auth::user()->representatives->id)->get();
        return view('representatives.repSales.manageServices',compact('services'));
    }
    public function addService()
    {
        $rep = Representative::findOrfail(Auth::user()->representatives->id);
        $customers = $rep->customers->where('statues',true);
        if($customers->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة خدمة، الرجاء اضافة على الاقل عميل واحد!!! أو ان العملاء الذين اضفتهم لم يتم تفعيلهم']);
        return view('representatives.repSales.addService',compact('customers'));
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
            'statues' => False,
            'representative_id' => Auth::user()->representatives->id,
        ]);
        $service->customers()->attach($request->cust_ids);
        return redirect('/repSales/manageServices')->with('status','تم إضافة البيانات بشكل ناجح');
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

        $rep = Representative::findOrfail(Auth::user()->representatives->id);
        $customers = $rep->customers->where('statues',true);
        if($customers->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة خدمة، الرجاء اضافة على الاقل عميل واحد!!! أو ان العملاء الذين اضفتهم لم يتم تفعيلهم']);
        return view('representatives.repSales.editService', compact('service'))
        ->with('customers',$customers);
    }
    public function updateService(Request $request,$id)
    {
        $service = Service::find($id);
        if($service->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $service->type = $request->type;
        $service->name = $request->name;
        $service->cost = $request->cost;

        $service->customers()->sync($request->cust_ids);        
        $service->update();
        return redirect('/repSales/manageServices')->with('status','تم تعديل البيانات بشكل ناجح');
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
