<?php

namespace App\Http\Controllers\Representatives\Science;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\PromotionMaterial;
use App\Models\Competitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\userTrait;

class PromotionController extends Controller
{
    use userTrait;
    public function getAllPromotionMaterials()
    {
        $competitors = Competitor::where('representative_id',Auth::user()->representatives->id)->with('PromotionMaterial')->whereHas('PromotionMaterial')->get();
        return view('representatives.repScience.managePromotionMaterials',compact('competitors'));
    }
    public function addPromotionMaterial()
    {
        return view('representatives.repScience.addPromotionMaterial');
    }
    public function storePromotionMaterial(Request $request)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }

        $file_name = null;
        if($request->hasfile('image'))
                $file_name = $this->saveImage($request->file('image'),'images/items/');
        $comp = Competitor::create([
            'item_name' => $request->item_name,
            'representative_id' => Auth::user()->representatives->id,
            ]);
        PromotionMaterial::create([
            'type' => $request->type,
            'targets' => $request->targets,
            'image' => $file_name,
            'competitor_id' => $comp->id,
            ]);
        
        return redirect('/repScience/managePromotionMaterials')->with('status','تم إضافة البيانات بشكل ناجح');
    }
    protected function getRules()
    {
        return $rules = [
                'item_name' => 'required|string|max:255',
                'type' => 'required|string|max:255',
                'targets' => 'required|string|max:255',
                'image' => 'required',
            ];
    }
    protected function getMessages()
    {
        return $messages = [
            'item_name.required' => 'يجب عليك كتابة هذا الحقل',
            'item_name.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'item_name.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',
            
            'type.required' => 'يجب عليك كتابة هذا الحقل',
            'type.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'type.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',

            'targets.required' => 'يجب عليك كتابة هذا الحقل',
            'targets.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'targets.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',

            'image.required' => 'يجب عليك كتابة هذا الحقل',
        ];
    }
    public function editPromotionMaterial($id)
    {
        $promotion = PromotionMaterial::find($id); 
        if($promotion->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        return view('representatives.repScience.editPromotionMaterial', compact('promotion'));
    }
    public function updatePromotionMaterial(Request $request,$id)
    {
        $promotionMaterial = PromotionMaterial::find($id);
        $competitor = Competitor::find($promotionMaterial->competitor->id);
        if($promotionMaterial->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);

        $file_name = $promotionMaterial->image;
        if($request->hasfile('image'))
        {
            $this->deleteFile($promotionMaterial->image,'images/items/');
            $file_name = $this->saveImage($request->file('image'),'images/items/');
        }
        $competitor->item_name = $request->item_name;
        $competitor->update();
        $promotionMaterial->type = $request->type;
        $promotionMaterial->targets = $request->targets;
        $promotionMaterial->update();
        
        return redirect('/repScience/managePromotionMaterials')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deletePromotionMaterial($id)
    {
        $promotionMaterial = PromotionMaterial::findOrfail($id);
        if($promotionMaterial->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $promotionMaterial->delete();

        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
        // return redirect('/repScience/managePromotionMaterials')->with('status','تم حذف البيانات بشكل ناجح');
    }
}