<?php

namespace App\Http\Controllers\Admin;
use App\Models\Company;
use App\Models\Item;
use App\Http\Controllers\Controller;
use App\Models\Specialist;
use App\Traits\userTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    use userTrait;
    public function getAllItems(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        $companies = Company::with('categories')->with('categories.items')->get();
        return view('admin.manageItems',compact('companies'));
    }
    public function addItem()
    {
        $companies = Company::all();
        if($companies->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك الاضافة لانه لاتوجد شركة لديها مجموعة اصناف']);
        $specialists = Specialist::all();
        return view('admin.addItem', compact('companies'))->with('specialists',$specialists);
    }
    public function storeItem(Request $request)
    {
        $rules = [
            'commercial_name' => 'required|string|max:255',
            'science_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'bonus' => 'required|numeric|max:255',
            // 'company_ids' => 'required',
        ];
        if(!$request->have_category) $rules +=['company_ids' => 'required',];
        $request->validate($rules);
        if($request->have_category){
            $category_id = $request->category_id;
        }
        else{
            $category_id = null;
        }
        $item = Item::create([
            'commercial_name' => $request->commercial_name,
            'science_name' => $request->science_name,
            'price' => $request->price,
            'bonus' => $request->bonus,
            'unit' => $request->unit,
            'category_id' =>$category_id,
        ]);
        if(!$request->have_category){
            $item->companies()->attach($request->company_ids);
        }
        if($request->specialist_ids)
            $item->specialists()->attach($request->specialist_ids);
        return redirect('/admin/manageItem')->with('status','تم إضافة البيانات بشكل ناجح');
    }
    protected function getRules()
    {
        return $rules = [
                'commercial_name' => 'required|string|max:255',
                'science_name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'bonus' => 'required|string|max:255',
                'company_ids' => 'required',
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
            'company_ids.required' => 'يجب عليك اختيارعلى الاقل شركة واحدة',
        ];
    }
    public function editItem($id)
    {
        $item = Item::find($id); 
        if($item->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $companies = Company::all();
        $specialists = Specialist::all();
        return view('admin.editItem', compact('item',$item))
        ->with('companies',$companies)->with('specialists',$specialists);
    }
    public function UpdateItem(Request $request,$id)
    {
        $item = Item::find($id);
        
        if($item->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $rules = [
            'commercial_name' => 'required|string|max:255',
            'science_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'bonus' => 'required|numeric|max:255',
            // 'company_ids' => 'required',
        ];
        if(!$request->have_category) $rules +=['company_ids' => 'required',];
        $request->validate($rules);
        if($request->category){   
            $category_id = $request->category_id;
        }else{
            $category_id = null;
        }
        $item->commercial_name = $request->Input('commercial_name');
        $item->science_name = $request->Input('science_name');
        $item->price = $request->Input('price');
        $item->bonus = $request->Input('bonus');
        $item->unit = $request->Input('unit');
        $item->category_id = $category_id;
        $item->update();

        if(!$request->have_category){
            $item->companies()->sync($request->company_ids);
        }
        if($request->specialist_ids)
            $item->specialists()->sync($request->specialist_ids);
        return redirect('/admin/manageItem')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteItem($id)
    {
        $item = Item::find($id);
        if($item->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $item->delete();
        
        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
    }
    public function showItemDetails($id)
    {
        $item = Item::with(['uses','specialists'])->findOrfail($id);
        if($item->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        return view('admin.showItemDetails',compact('item'));
    }
}
