<?php

namespace App\Http\Controllers\Managers\marketing;
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
    use userTrait;//for save images

    public function getAllCompanies(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        $company = Company::whereHas('supervisor')->get();
        return view('managers.marketing.manageCompanies',compact('company',$company));
    }
    public function addCompany()
    {
        $supervisor = Supervisor::whereHas('user')->get();
        return view('managers.marketing.addCompany', compact('supervisor',$supervisor));
    }
    public function storeCompany(Request $request)
    {
        $request->validate([
            'name_company' => 'required|string|max:255',
            'country_manufacturing' => 'required|string|max:255',
            'sign_img_company' => 'required',
        ]);
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
        return redirect('/managerMarketing/manageCompanies')->with('status','تم إضافة البيانات بشكل ناجح');
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
        return view('showCompanyDetails.editCompany', compact('company',$company))->with('supervisors',$supervisors);
    }
    public function UpdateCompany(Request $request,$id)
    {
        $company = Company::findOrfail($id);
        if($company->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $request->validate([
            'name_company' => 'required|string|max:255',
            'country_manufacturing' => 'required|string|max:255',
            // 'sign_img_company' => 'required',
        ]);
        $file_name = $company->sign_img_company;
        if($request->hasfile('sign_img_company'))
        {
            $this->deleteFile($company->sign_img_company,'images/signsCompany/');
            $file_name = $this->saveImage($request->file('sign_img_company'),'images/signsCompany/');
        }
        $company->name_company = $request->name_company;
        $company->country_manufacturing = $request->country_manufacturing;
        $company->sign_img_company = $file_name;
        $company->have_category = $request->have_category;
        $company->supervisor_id = $request->supervisor_id;
        $company->update();
        return redirect('/managerMarketing/manageCompanies')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteCompany($id)
    {
        $company = Company::findOrfail($id);
        if(!$company)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $this->deleteFile($company->sign_img_company,'images/signsCompany/');
        $company->delete();
        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
        // return redirect('/managerMarketing/manageCompanies')->with('status','تم حذف البيانات بشكل ناجح');
    }
    public function showCompanyDetails($id)
    {
        $company = Company::with(['categories','items'])->findOrfail($id);
        if($company->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        return view('managers.marketing.showCompanyDetails',compact('company'));
    }
}
