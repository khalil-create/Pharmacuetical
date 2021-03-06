<?php

namespace App\Http\Controllers\Managers\Sales;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Manager;
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
        return view('managers.sales.manageOrders',compact('orders'));
    }
    public function addOrder()
    {
        $managerSales = Manager::find(Auth::user()->manager->id);
        $SalesReps = $managerSales->representatives;
        if($SalesReps->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة طلبية، الرجاء اضافة على الاقل مندوب مبيعات واحد!!! ']);
        $customers = collect();
        foreach($SalesReps as $rep){
            $customers = $customers->concat($rep->customers->where('statues',true));
        }
        if($customers->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة طلبية، الرجاء اضافة على الاقل عميل واحد!!! أو ان العملاء الذين اضفتهم لم يتم تفعيلهم']);
        $items = Item::all();
        // $reps = Representative::with('user')
        // ->where('manager_id',Auth::user()->manager->id)->get();
        return view('managers.sales.addOrder',compact('customers'))
        ->with('items',$items);
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
        $repSales = $cust->representative->whereNotNull('manager_id')->first();

        $cust_order_registered = Order::where('customer_id',$cust->id)->where('item_id',$request->item_id)
        ->where('representative_id',$repSales->id)->first();
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
                'representative_id' => $repSales->id,
            ]);
        }
        return redirect('/managerSales/manageOrders')->with('status','تم إضافة البيانات بشكل ناجح');
    }
    protected function getRules()
    {
        return $rules = [
                'count' => 'required|numeric',
                'bonus' => 'required|numeric',
                'note' => 'required|string',
                ];
    }
    protected function getMessages()
    {
        return $messages = [
            'count.required' => 'يجب عليك كتابة هذا الحقل',
            'count.numeric' => 'يجب ان يكون هذا الحقل رقم',

            'bonus.required' => 'يجب عليك كتابة هذا الحقل',
            'bonus.numeric' => 'يجب ان يكون هذا الحقل رقم',

            'note.required' => 'يجب عليك كتابة هذا الحقل',
            'note.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
        ];
    }
    public function editOrder($id)
    {
        $customers = Customer::where('statues',true)->get();
        if($customers->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة طلبية، الرجاء اضافة على الاقل عميل واحد!!! أو ان العملاء الذين اضفتهم لم يتم تفعيلهم']);
        $items = Item::all();
        $reps = Representative::with('user')
        ->where('manager_id',Auth::user()->manager->id)->get();

        $order = Order::find($id); 
        if($order->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);

        return view('managers.sales.editOrder', compact('order'))
        ->with('customers',$customers)->with('items',$items)->with('reps',$reps);
    }
    public function updateOrder(Request $request,$id)
    {
        $order = Order::find($id);
        if($order->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);

        $order->customer_id = $request->customer_id;
        $order->item_id = $request->item_id;
        $order->count = $request->count;
        $order->bonus = $request->bonus;
        $order->note = $request->note;

        $order->update();

        return redirect('/managerSales/manageOrders')->with('status','تم تعديل البيانات بشكل ناجح');
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
}
