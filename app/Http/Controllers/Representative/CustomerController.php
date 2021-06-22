<?php

namespace App\Http\Controllers\Representative;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\representative;
use App\Models\User;
use App\Models\SubArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\userTrait;
class CustomerController extends Controller
{
    use userTrait;
    public function getAllCustomers()
    {
        $customers = Customer::where('representative_id',Auth::user()->representatives->id)->get();
        return view('representatives.repScience.manageCustomers',compact('customers'));
    }
    public function addCustomer()
    {
        return view('representatives.repScience.addCustomer');
    }
    public function storeCustomer(Request $request)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        Customer::create([
            'name' => $request->name,
            'type' => $request->type,
            'owner_name' => $request->owner_name,
            'owner_phone' => $request->owner_phone,
            'owner_tel' => $request->owner_tel,
            'contact_official_name' => $request->contact_official_name,
            'contact_official_type' => $request->contact_official_type,
            'contact_official_phone' => $request->contact_official_phone,
            'size' => $request->size,
            'loyalty' => $request->loyalty,
            'address' => $request->address,
            'statues' => False,
            'representative_id' => Auth::user()->representatives->id,
        ]);
        
        return redirect('/representative/manageCustomers')->with('status','تم إضافة البيانات بشكل ناجح');
    }
    protected function getRules()
    {
        return $rules = [
                'name' => 'required|string|max:255|unique:customers',
                'owner_name' => 'required|string|max:255',
                'owner_phone' => 'required|numeric|max:799999999',
                'owner_tel' => 'required|numeric|max:9999999',
                'contact_official_name' => 'required|string|max:255',
                'contact_official_type' => 'required|string|max:255',
                'contact_official_phone' => 'required|numeric|max:9999999',
                'address' => 'required|string|max:255',
            ];
    }
    protected function getMessages()
    {
        return $messages = [
            'name.required' => 'يجب عليك كتابة هذا الحقل',
            'name.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'name.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',
            'name.unique' => 'هذا العميل قد تمت اضافته',
            
            'owner_name.required' => 'يجب عليك كتابة هذا الحقل',
            'owner_name.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'owner_name.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',

            'owner_phone.required' => 'يجب عليك كتابة هذا الحل',
            'owner_phone.numeric' => 'يجب ان يكون هذا الحقل رقم',
            'owner_phone.max' => 'يجب ان لايتجاوز عدد الارقام اكثر من 9',

            'owner_tel.required' => 'يجب عليك كتابة هذا الحل',
            'owner_tel.numeric' => 'يجب ان يكون هذا الحقل رقم',
            'owner_tel.max' => 'يجب ان لايتجاوز عدد الارقام اكثر من 7',

            'contact_official_name.required' => 'يجب عليك كتابة هذا الحقل',
            'contact_official_name.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'contact_official_name.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',

            'contact_official_type.required' => 'يجب عليك كتابة هذا الحقل',
            'contact_official_type.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'contact_official_type.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',

            'address.required' => 'يجب عليك كتابة هذا الحقل',
            'address.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'address.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',
        ];
    }
    public function editCustomer($id)
    {
        $customer = Customer::find($id); 
        if($customer->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        return view('representatives.repScience.editCustomer', compact('customer'));
    }
    public function updateCustomer(Request $request,$id)
    {
        $customer = Customer::find($id);
        if($customer->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $customer->name = $request->name;
        $customer->type = $request->type;
        $customer->owner_name = $request->owner_name;
        $customer->owner_phone = $request->owner_phone;
        $customer->owner_tel = $request->owner_tel;
        $customer->contact_official_name = $request->contact_official_name;
        $customer->contact_official_type = $request->contact_official_type;
        $customer->contact_official_phone = $request->contact_official_phone;
        $customer->size = $request->size;
        $customer->loyalty = $request->loyalty;
        $customer->address = $request->address;
        $customer->representative_id = Auth::user()->representatives->id;
        $customer->update();
        
        return redirect('/representative/manageCustomers')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteCustomer($id)
    {
        $customer = Customer::findOrfail($id);
        if($customer->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $customer->delete();

        return redirect('/representative/manageCustomers')->with('status','تم حذف البيانات بشكل ناجح');
    }
}
