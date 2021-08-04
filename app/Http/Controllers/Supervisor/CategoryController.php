<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Company;
use App\Traits\userTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    use userTrait;
    public function getAllCategories(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        $companies = Company::where('supervisor_id',Auth::user()->supervisor->id)->get();
        
        // $cat = Category::with('companies')->where('company.supervisor_id',Auth::user()->supervisor->id)->get();
        return view('supervisors.manageCategories',compact('companies',$companies));
    }
    public function addCategory()
    {
        $company = Company::where('supervisor_id',Auth::user()->supervisor->id)->get();
        return view('supervisors.addCategory', compact('company',$company));
    }
    public function storeCategory(Request $request)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $company = Company::find($request->company_id);
        $cat = Category::create([
            'name_cat' => $request->name_cat,
        ]);  
        //attach is add the new value above the old value even the new is the same old value
        $company->categories()->attach($cat->id);
        
        return redirect('/supervisor/manageCategory')->with('status','تم إضافة البيانات بشكل ناجح');
    }
    protected function getRules()
    {
        return $rules = [
                'name_cat' => 'required|string|max:255',
            ];
    }
    protected function getMessages()
    {
        return $messages = [
            'name_cat.required' => 'يجب عليك كتابة اسم المجموعة',
        ];
    }
    public function editCategory($id)
    {
        $category = Category::find($id); 
        if($category->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $companies = Company::where('supervisor_id',Auth::user()->supervisor->id)->get();
        return view('supervisors.editCategory', compact('category',$category))->with('companies',$companies);
    }
    public function UpdateCategory(Request $request,$id)
    {
        $category = Category::find($id);
        if($category->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $category->name_cat = $request->name_cat;
        $category->update();
        
        //sync is delete the old value and add the new value
        $category->companies()->sync($request->company_id);

        return redirect('/supervisor/manageCategory')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteCategory($id)
    {
        $category = Category::findOrfail($id);
        if($category->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $category->delete();

        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
        // return redirect('/supervisor/manageCategory')->with('status','تم حذف البيانات بشكل ناجح');
    }
}
