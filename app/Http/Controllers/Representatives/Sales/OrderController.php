<?php

namespace App\Http\Controllers\Representatives\Sales;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Order;
use App\Models\Representative;
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
        $orders = Order::where('representative_id',Auth::user()->representatives->id)->get();
        return view('representatives.repSales.manageOrders',compact('orders'));
    }
    public function addOrder()
    {
        $rep = Representative::findOrfail(Auth::user()->representatives->id);
        $customers = $rep->customers->where('statues',true);
        $items = Item::all();
        if($customers->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة طلبية، الرجاء اضافة على الاقل عميل واحد!!! أو ان العملاء الذين اضفتهم لم يتم تفعيلهم']);
        return view('representatives.repSales.addOrder',compact('customers'))->with('items',$items);
    }
    public function storeOrder(Request $request)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        Order::create([
            'customer_id' => $request->customer_id,
            'item_id' => $request->item_id,
            'count' => $request->count,
            'bonus' => $request->bonus,
            'note' => $request->note,
            'representative_id' => Auth::user()->representatives->id,
        ]);
        /////////////// Notify user //////////////////////////
        $manager_sales_id = Auth::user()->representatives->manager->user->id;
        $this->notifyUser('طلبيات','لديك طلبية جديدة',$manager_sales_id);
        return redirect('/repSales/manageOrders')->with('status','تم إضافة البيانات بشكل ناجح');
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
        $rep = Representative::findOrfail(Auth::user()->representatives->id);
        $customers = $rep->customers->where('statues',true);
        $items = Item::all();

        $order = Order::find($id); 
        if($order->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);

        return view('representatives.repSales.editOrder', compact('order'))
        ->with('customers',$customers)->with('items',$items);
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

        return redirect('/repSales/manageOrders')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteOrder($id)
    {
        $order = Order::findOrfail($id);
        if($order->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $order->delete();

        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
    }
}
