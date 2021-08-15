<?php

namespace App\Http\Controllers\Representatives\Science;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Alternative;
use App\Models\Competitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\userTrait;

class AlternativeController extends Controller
{
    use userTrait;
    public function getAllAlternatives(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        $competitors = Competitor::where('representative_id',Auth::user()->representatives->id)->with('alternative')->whereHas('alternative')->get();
        return view('representatives.repScience.manageAlternatives',compact('competitors'));
    }
    public function addAlternative()
    {
        return view('representatives.repScience.addAlternative');
    }
    public function storeAlternative(Request $request)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $promotion = implode('++',$request->promotion_materials);
        $comp = Competitor::create(['representative_id' => Auth::user()->representatives->id,]);
        Alternative::create([
            'commercial_name' => $request->commercial_name,
            'agency_name' => $request->agency_name,
            'company_name' => $request->company_name,
            'country_manufacturing' => $request->country_manufacturing,
            'refill' => $request->refill,
            'price' => $request->price,
            'bonus' => $request->bonus,
            'unit' => $request->unit,
            'promotion_materials' => $promotion,
            'date' => $request->date,
            'competitor_id' => $comp->id,
        ]);
        
        return redirect('/repScience/manageAlternatives')->with('status','تم إضافة البيانات بشكل ناجح');
    }
    protected function getRules()
    {
        return $rules = [
                'commercial_name' => 'required|string|max:255',
                'agency_name' => 'required|string|max:255',
                'company_name' => 'required|string|max:255',
                'country_manufacturing' => 'required|string|max:255',
                'refill' => 'required|numeric|max:999',
                'price' => 'required|numeric|max:9999',
                'bonus' => 'required|numeric|max:100',
                'promotion_materials' => 'required',
                'date' => 'required',
            ];
    }
    protected function getMessages()
    {
        return $messages = [
            'commercial_name.required' => 'يجب عليك كتابة هذا الحقل',
            'commercial_name.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'commercial_name.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',
            
            'agency_name.required' => 'يجب عليك كتابة هذا الحقل',
            'agency_name.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'agency_name.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',

            'company_name.required' => 'يجب عليك كتابة هذا الحقل',
            'company_name.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'company_name.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',

            'country_manufacturing.required' => 'يجب عليك كتابة هذا الحقل',
            'country_manufacturing.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'country_manufacturing.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',

            'refill.required' => 'يجب عليك كتابة هذا الحقل',
            'refill.numeric' => 'يجب ان يكون هذا الحقل عدداً وليس نص',
            'refill.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 1000',

            'price.required' => 'يجب عليك كتابة هذا الحقل',
            'price.numeric' => 'يجب ان يكون هذا الحقل عدداً وليس نص',
            'price.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 9999',

            'bonus.required' => 'يجب عليك كتابة هذا الحقل',
            'bonus.numeric' => 'يجب ان يكون هذا الحقل عدداً وليس نص',
            'bonus.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 100',

            'promotion_materials.required' => 'يجب عليك الاختيار من هذه القائمة',
            'date.required' => 'يجب عليك كتابة هذا الحقل',
        ];
    }
    public function editAlternative($id)
    {
        $alt = Alternative::find($id); 
        if($alt->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        return view('representatives.repScience.editAlternative', compact('alt'));
    }
    public function updateAlternative(Request $request,$id)
    {
        $alternative = Alternative::find($id);
        if($alternative->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);

        $promotion = implode('++',$request->promotion_materials);
        $alternative->commercial_name = $request->commercial_name;
        $alternative->agency_name = $request->agency_name;
        $alternative->company_name = $request->company_name;
        $alternative->country_manufacturing = $request->country_manufacturing;
        $alternative->refill = $request->refill;
        $alternative->price = $request->price;
        $alternative->bonus = $request->bonus;
        $alternative->unit = $request->unit;
        $alternative->promotion_materials = $promotion;
        $alternative->date = $request->date;
        $alternative->update();
        
        return redirect('/repScience/manageAlternatives')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteAlternative($id)
    {
        $alternative = Alternative::findOrfail($id);
        if($alternative->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $alternative->delete();

        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
        // return redirect('/repScience/manageAlternatives')->with('status','تم حذف البيانات بشكل ناجح');
    }
    public function showAlternativeDetails($id)
    {
        $alternative = Alternative::findOrfail($id);
        if($alternative->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        return view('representatives.repScience.showAlternativeDetails',compact('alternative'));
    }
}
