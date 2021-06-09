<?php

namespace App\Http\Controllers\Admin;
use App\Models\Supervisor;
use App\Models\Company;
use App\Models\User;
use App\Traits\userTrait;
use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use userTrait;//for save images of users

    public function getAllCompanies()
    {
        $company = Company::whereHas('supervisor')->get();
        return view('admin.manageCompany',compact('company',$company));
    }
    public function addCompany()
    {
        $supervisor = Supervisor::whereHas('user')->get();
        return view('admin.addCompany', compact('supervisor',$supervisor));
    }
    public function storeCompany(Request $request)
    {
        $file_name = null;
        if($request->hasfile('sign_img_company'))
                $file_name = $this->saveImage($request->file('sign_img_company'),'images/signsCompany/');
        Company::create([
            'name_company' => $request->name_company,
            'country_manufacturing' => $request->country_manufacturing,
            'have_category' => $request->have_category,
            'sign_img_company' => $file_name,
            'supervisor_id' => $request->supervisor_id,
        ]);
        return redirect('/manageCompany')->with('status','تم إضافة البيانات بشكل ناجح');
    }
    protected function getRules()
    {
        return $rules = [
                'name_company' => 'required|string|max:255',
                'country_manufacturing' => 'required|string|max:255',
                'sign_img_company' => 'required|string|max:255',
            ];
    }
    protected function getMessages()
    {
        return $messages = [
            'name_company.required' => 'يجب عليك كتابة المنطقة الرئيسية',
            'country_manufacturing.required' => 'يجب عليك كتابة بلد التصنيع',
            'sign_img_company.required' => 'يجب عليك تحميل الصورة  ',
        ];
    }
    public function editCompany($id)
    {
        $company = Company::find($id); 
        if(!$company)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $supervisors = Supervisor::whereHas('user')->get();
        return view('admin.editCompany', compact('company',$company))->with('supervisors',$supervisors);
    }
    public function UpdateCompany(Request $request,$id)
    {
        $company = Company::findOrfail($id);
        if($company->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $file_name = $company->sign_img_company;
        if($request->hasfile('sign_img_company'))
            $file_name = $this->saveImage($request->file('sign_img_company'),'images/signsCompany/');

        $company->name_company = $request->name_company;
        $company->country_manufacturing = $request->country_manufacturing;
        $company->have_category = $request->have_category;
        $company->sign_img_company = $file_name;
        $company->supervisor_id = $request->supervisor_id;
        $company->update();
        return redirect('/manageCompany')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteCompany($id)
    {
        $company = Company::findOrfail($id);
        if(!$company)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        // $s = $company->categories()->get();
        // foreach($s as $d)
        // {            
        //     $cc = Item::where('category_id',$d->id)->get();
        //     foreach($cc as $c){
        //         $dd = Item::find($c->id);
        //         $dd->delete();
        //     }
        // }
        // // $company->categories()->items()->delete();
        // $company->categories()->delete();
        $company->delete();

        return redirect('/manageCompany')->with('status','تم حذف البيانات بشكل ناجح');
    }
}
