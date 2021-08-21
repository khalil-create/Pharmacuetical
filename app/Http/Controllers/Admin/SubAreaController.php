<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Subarea;
use App\Models\User;
use App\Models\Supervisor;
use App\Models\Mainarea;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Representative;
use App\Traits\userTrait;
use Illuminate\Support\Facades\Auth;

class SubAreaController extends Controller
{
    use userTrait;
    public function getAllSubArea(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        $subArea = Subarea::with('mainarea')->get();

        // if(!($subArea->count() > 0))
        //     return view('admin.manageSubAreas')->with('status','لايوجد مناطق فرعية الرجاء اضافة منطقة فرعية');
        return view('admin.manageSubAreas')->with('subArea',$subArea);
    }
    public function addSubArea($id)
    {
        $mainareas = Mainarea::all();
        if(isset($id) && $id != 0){
            $mainarea = Mainarea::find($id);
            return view('admin.addSubArea')->with('mainarea',$mainarea);
        }
        return view('admin.addSubArea', compact('mainareas',$mainareas));
    }
    public function storeSubArea(Request $request,$id)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        Subarea::create([
            'name_sub_area' => $request->name_sub_area,
            'mainarea_id' =>$request->main_area_id,
        ]);   
        if(isset($id) && $id != 0)
            return redirect('/admin/supAreas/'.$id)->with('status','تم إضافة البيانات بشكل ناجح');
        return redirect('/admin/manageSubAreas')->with('status','تم إضافة البيانات بشكل ناجح');
    }
    protected function getRules()
    {
        return $rules = [
                'name_sub_area' => 'required|string|max:255|unique:subareas',
            ];
    }
    protected function getMessages()
    {
        return $messages = [
            'name_sub_area.required' => 'يجب عليك كتابة المنطقة الفرعية',
            'name_sub_area.unique' => 'هذه المنطقة موجوده مسبقاً',
            'name_sub_area.string' => 'يجب عليك كتابة هذا الحقل بشكل نصي',
            'name_sub_area.max' => 'يجب ان لاتتجاوز عدد الأحرف لأكثر من 255 حرفاً',
        ];
    }
    public function editSubArea($id)
    {
        $subarea = Subarea::find($id);
        if(!$subarea)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $mainareas = Mainarea::all();
        return view('admin.editSubArea', compact('subarea'))->with('mainareas',$mainareas);
    }
    public function UpdateSubArea(Request $request,$id)
    {
        $subarea = Subarea::find($id);
        if($subarea->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        if($subarea->name_sub_area == $request->name_sub_area)
            $rules = ['name_sub_area' => 'required|string|max:255', ];
        else
            $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $subarea->name_sub_area = $request->Input('name_sub_area');
        $subarea->mainarea_id = $request->sub_area_id;
        $subarea->update();

        return redirect('/admin/manageSubAreas')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteSubArea($id)
    {
        $subarea = Subarea::find($id);
        if($subarea->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $subarea->delete();
        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
        // return redirect('/admin/manageSubAreas')->with('status','تم حذف البيانات بشكل ناجح');
    }
    public function showSubareaReps($id)
    {
        $subarea = Subarea::find($id);
        $reps = $subarea->representatives;
        return view('admin.showSubareaReps', compact('subarea',$subarea))->with('reps',$reps);
    }
    public function showSubareaDetails($id)
    {
        $subarea = Subarea::with('representatives')->findOrfail($id);
        if($subarea->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        return view('admin.showSubareaDetails',compact('subarea'));
    }
    public function addSubareaReps($id)
    {
        $subarea = Subarea::find($id);
        $reps = Representative::all();
        if($reps->count() < 1)
            return redirect()->back()->with(['error' => 'لايوجد مندوبيين لـ إضافتهم، الرجاء قم بإضافة على الاقل مندوب واحد']);
        return view('admin.addSubareaReps', compact('subarea',$subarea))->with('reps',$reps);
    }
    public function storeSubareaReps(Request $request,$id)
    {
        $rules = ['rep_ids' => 'required'];
        $messages = ['rep_ids.required' => 'يجب ان تختار على الاقل مندوب واحد'];
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $subarea = Subarea::findOrfail($id);
        if($subarea->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $subarea->representatives()->sync($request->rep_ids);

        return redirect('/admin/showSubareaReps/'.$id)->with('status','تم اضافة المناطق للمندوب بشكل ناجح');
    }
}
