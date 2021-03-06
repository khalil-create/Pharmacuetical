<?php

namespace App\Http\Controllers\Supervisor;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;
use App\Models\Representative;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\userTrait;
class OrderController extends Controller
{
    use userTrait;
    public function getAllOrders(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        $supervisor = Supervisor::findOrfail(Auth::user()->supervisor->id);
        return view('supervisors.manageOrders',compact('supervisor'));
    }
    public function addOrder()
    {
        $supervisor = Supervisor::find(Auth::user()->supervisor->id);
        $reps = $supervisor->representatives;
        $customers = collect();
        foreach($reps as $rep){
            $customers = $customers->concat($rep->customers->where('statues',true));
        }
        if($customers->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة طلبية، الرجاء اضافة على الاقل عميل واحد!!! أو ان العملاء الذين اضفتهم لم يتم تفعيلهم']);
        return view('supervisors.addOrder',compact('supervisor'))->with('customers',$customers);
    }
    public function storeOrder(Request $request)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $cust = Customer::find($request->customer_id);
        $repSience = $cust->representative->whereNotNull('supervisor_id')->first();

        $cust_order_registered = Order::where('customer_id',$cust->id)->where('item_id',$request->item_id)
        ->where('representative_id',$repSience->id)->first();
        if($cust_order_registered){
            $cust_order_registered->count += $request->count;
            $cust_order_registered->note = $request->note;
            $cust_order_registered->update();
        }
        else{
            Order::create([
                'customer_id' => $cust->id,
                'item_id' => $request->item_id,
                'count' => $request->count,
                // 'bonus' => $request->bonus,
                'note' => $request->note,
                'representative_id' => $repSience->id,
            ]);
        }
        return redirect('/supervisor/manageOrders')->with('status','تم إضافة البيانات بشكل ناجح');
    }
    protected function getRules()
    {
        return $rules = [
                'count' => 'required|numeric',
                // 'bonus' => 'required|numeric',
                'note' => 'required|string',
                ];
    }
    protected function getMessages()
    {
        return $messages = [
            'count.required' => 'يجب عليك كتابة هذا الحقل',
            'count.numeric' => 'يجب ان يكون هذا الحقل رقم',

            // 'bonus.required' => 'يجب عليك كتابة هذا الحقل',
            // 'bonus.numeric' => 'يجب ان يكون هذا الحقل رقم',

            'note.required' => 'يجب عليك كتابة هذا الحقل',
            'note.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
        ];
    }
    public function editOrder($id)
    {
        $supervisor = Supervisor::find(Auth::user()->supervisor->id);
        $reps = $supervisor->representatives;
        $customers = collect();
        foreach($reps as $rep){
            $customers = $customers->concat($rep->customers->where('statues',true));
        }
        $order = Order::find($id); 
        if($order->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);

        return view('supervisors.editOrder', compact('supervisor'))
        ->with('customers',$customers)->with('order',$order);
    }
    public function updateOrder(Request $request,$id)
    {
        $order = Order::find($id);
        if($order->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);

        $order->customer_id = $request->customer_id;
        $order->item_id = $request->item_id;
        $order->count = $request->count;
        // $order->bonus = $request->bonus;
        $order->note = $request->note;

        $order->update();

        return redirect('/supervisor/manageOrders')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteOrder($id)
    {
        $order = Order::findOrfail($id);
        if($order->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $order->delete();

        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
        // return redirect('/supervisor/manageOrders')->with('status','تم حذف البيانات بشكل ناجح');
    }
    public function showOrderDetails($id)
    {
        $order = Order::with('customer')->findOrfail($id);
        if($order->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        return view('supervisors.showOrderDetails',compact('order'));
    }
}
