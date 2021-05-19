<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAllCategories()
    {
        $cat = Category::with('companies')->get();
        return view('admin.manageCategories',compact('cat',$cat));
    }
    public function addCategory()
    {
        $company = Company::all();
        return view('admin.addCategory', compact('company',$company));
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
            // 'name_company' => $request->company_name,
            //'company_id' =>$company->id,
        ]);  
        //attach is add the new value above the old value even the new is the same old value
        $company->categories()->attach($cat->id);
        
        return redirect('/manageCategories')->with('status','تم إضافة البيانات بشكل ناجح');
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
        $companies = Company::all();
        return view('admin.editCategory', compact('category',$category))->with('companies',$companies);
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

        return redirect('/manageCategories')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteCategory($id)
    {
        $category = Category::findOrfail($id);
        if($category->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $category->items()->delete();
        $category->delete();

        return redirect('/manageCategories')->with('status','تم حذف البيانات بشكل ناجح');
    }
}
