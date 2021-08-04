<?php

namespace App\Http\Controllers\Supervisor;
use App\Models\Item;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Traits\userTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    use userTrait;
    public function getAllItems($have_category,Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        if($have_category){
            $companies = Company::with('categories')->with('categories.items')
            ->where('supervisor_id',Auth::user()->supervisor->id)->where('have_category',1)->get();
            return view('supervisors.manageItems',compact('companies'));
        }
        else{
            $companies = Company::with('items')
            ->where('supervisor_id',Auth::user()->supervisor->id)->where('have_category',0)->get();
            return view('supervisors.manageItemsNoCat',compact('companies'));
        }
    }
    public function addItem($have_category)
    {
        if($have_category){
            $companies = Company::where('supervisor_id',Auth::user()->supervisor->id)
            ->where('have_category',1)->get();
            if($companies->count() < 1)
                return redirect()->back()->with(['error' => 'لايمكنك الاضافة لانه لاتوجد شركة لديها مجموعة اصناف']);
        }
        else{
            $companies = Company::where('have_category',0)->where('supervisor_id',Auth::user()->supervisor->id)->get();
            if($companies->count() < 1)
                return redirect()->back()->with(['error' => 'لايمكنك الاضافة لانه لاتوجد شركة ليس لديها مجموعة اصناف']);
        }
        return view('supervisors.addItem', compact('companies'))
            ->with('have_category',$have_category);
    }
    public function storeItem(Request $request,$have_category)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        if($have_category){
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
            'category_id' =>$request->category_id,
        ]);
        if(!$have_category){
            $item->companies()->attach($request->company_ids);
        }
        return redirect('/supervisor/manageItem/'.$have_category)->with('status','تم إضافة البيانات بشكل ناجح');
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
        if($item->category){
            $companies = Company::where('supervisor_id',Auth::user()->supervisor->id)
            ->where('have_category',1)->get();
            $have_category = 1;
        }
        else{
            $companies = Company::where('supervisor_id',Auth::user()->supervisor->id)
            ->where('have_category',0)->get();
            $have_category = 0;
        }
        return view('supervisors.editItem', compact('item',$item))
        ->with('companies',$companies)->with('have_category',$have_category);
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
        if($item->category){   
            $categoru_id = $request->category_id;
            $have_category = 1;
        }else{
            $categoru_id = null;
            $have_category = 0;
        }
        $item->commercial_name = $request->Input('commercial_name');
        $item->science_name = $request->Input('science_name');
        $item->price = $request->Input('price');
        $item->bonus = $request->Input('bonus');
        $item->unit = $request->Input('unit');
        $item->category_id = $request->category_id;
        $item->update();

        if(!$have_category){
            $item->companies()->sync($request->company_ids);
        }

        return redirect('/supervisor/manageItem/'.$have_category)->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteItem($id)
    {
        $item = Item::find($id);
        if($item->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        if($item->category_id != null)
            $have_category = 1;
        else
            $have_category = 0;
        $item->delete();
        
        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
        // return redirect('/supervisor/manageItem/'.$have_category)->with('status','تم حذف البيانات بشكل ناجح');
    }
}
