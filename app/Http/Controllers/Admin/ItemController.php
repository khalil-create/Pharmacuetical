<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use App\Models\Item;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function getAllItems()
    {
        $items = Item::whereHas('category')->get();
        return view('admin.manageItems',compact('items',$items));
    }
    public function addItem()
    {
        $category = Category::all();
        return view('admin.addItem', compact('category',$category));
    }
    public function storeItem(Request $request)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $item = Item::create([
            'commercial_name' => $request->commercial_name,
            'science_name' => $request->science_name,
            'price' => $request->price,
            'bonus' => $request->bonus,
            'unit' => $request->unit,
            'category_id' =>$request->category_id,
        ]);
        return redirect('/admin/manageItems')->with('status','تم إضافة البيانات بشكل ناجح');
    }
    protected function getRules()
    {
        return $rules = [
                'commercial_name' => 'required|string|max:255',
                'science_name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'bonus' => 'required|string|max:255',
            ];
    }
    protected function getMessages()
    {
        return $messages = [
            'commercial_name.required' => 'يجب عليك كتابة الاسم التجاري',
            'science_name.required' => 'يجب عليك كتابة الاسم العلمي',
            'price.required' => 'يجب عليك كتابة السعر',
            'price.numeric' => 'يجب ان يكون هذا الحقل عدد',
            'bonus.required' => 'يجب عليك كتابة البونص',
        ];
    }
    public function editItem($id)
    {
        $item = Item::find($id); 
        if($item->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $categories = Category::all();
        return view('admin.editItem', compact('item',$item))->with('categories',$categories);
    }
    public function UpdateItem(Request $request,$id)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $item = Item::find($id);
        
        if($item->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $item->commercial_name = $request->Input('commercial_name');
        $item->science_name = $request->Input('science_name');
        $item->price = $request->Input('price');
        $item->bonus = $request->Input('bonus');
        $item->unit = $request->Input('unit');
        $item->category_id = $request->category_id;
        $item->update();

        return redirect('/admin/manageItems')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteItem($id)
    {
        $item = Item::find($id);
        if($item->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $item->delete();
        return redirect('/admin/manageItems')->with('status','تم حذف البيانات بشكل ناجح');
    }
}
