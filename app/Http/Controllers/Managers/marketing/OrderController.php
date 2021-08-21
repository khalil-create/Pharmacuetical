<?php

namespace App\Http\Controllers\Managers\marketing;
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
        $orders = Order::all();
        return view('managers.marketing.manageOrders',compact('orders'));
    }
    public function addOrder()
    {
        $SalesReps = Representative::whereHas('manager')->get();
        if($SalesReps->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة طلبية، الرجاء اضافة على الاقل مندوب مبيعات واحد!!! ']);
        $customers = collect();
        foreach($SalesReps as $rep){
            $customers = $customers->concat($rep->customers->where('statues',true));
        }
        if($customers->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة طلبية، الرجاء اضافة على الاقل عميل واحد!!! أو ان العملاء الذين اضفتهم لم يتم تفعيلهم']);
        $items = Item::all();
        return view('managers.marketing.addOrder',compact('customers'))->with('items',$items);
    }
    public function storeOrder(Request $request)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        // Order::create([
        //     'customer_id' => $request->customer_id,
        //     'item_id' => $request->item_id,
        //     'count' => $request->count,
        //     'bonus' => $request->bonus,
        //     'note' => $request->note,
        //     'representative_id' => $request->rep_id,
        // ]);
        $cust = Customer::find($request->customer_id);
        $reps = $cust->representative->toArray();
        $repSales = $reps[0];
        if(!$reps[0]['manager_id'])
            $repSales = $reps[0];
        $cust_order_registered = Order::where('customer_id',$cust->id)->where('item_id',$request->item_id)
        ->where('representative_id',$repSales['id'])->first();
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
                'note' => $request->note,
                'representative_id' => $repSales['id'],
            ]);
        }
        return redirect('/managerMarketing/manageOrders')->with('status','تم إضافة البيانات بشكل ناجح');
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
        $SalesReps = Representative::whereHas('manager')->get();
        if($SalesReps->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة طلبية، الرجاء اضافة على الاقل مندوب مبيعات واحد!!! ']);
        // $customers = collect();
        // foreach($SalesReps as $rep){
        //     $customers = $customers->concat($rep->customers->where('statues',true));
        // }
        // if($customers->count() < 1)
        //     return redirect()->back()->with(['error' => 'لايمكنك اضافة طلبية، الرجاء اضافة على الاقل عميل واحد!!! أو ان العملاء الذين اضفتهم لم يتم تفعيلهم']);
            
        $order = Order::find($id); 
        if($order->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $items = Item::all();
        return view('managers.marketing.editOrder', compact('items'))->with('order',$order);
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

        return redirect('/managerMarketing/manageOrders')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteOrder($id)
    {
        $order = Order::findOrfail($id);
        if($order->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $order->delete();

        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
        // return redirect('/managerMarketing/manageOrders')->with('status','تم حذف البيانات بشكل ناجح');
    }
    public function showOrderDetails($id)
    {
        $order = Order::with('customer')->findOrfail($id);
        if($order->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        return view('managers.marketing.showOrderDetails',compact('order'));
    }
}
