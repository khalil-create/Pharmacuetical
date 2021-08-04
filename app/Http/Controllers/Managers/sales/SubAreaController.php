<?php

namespace App\Http\Controllers\Managers\Sales;

use Illuminate\Http\Request;
use App\Models\Subarea;
use App\Models\User;
use App\Models\Supervisor;
use App\Models\Mainarea;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class SubAreaController extends Controller
{
    public function getAllSubArea(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        $subAreas = Subarea::with('mainarea')->get();
        return view('managers.sales.manageSubAreas')->with('subAreas',$subAreas);
    }
    public function addSubArea($id){
        $mainareas = Mainarea::all();
        if($mainareas->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة منطقة فرعية قبل مايتم اضافة على الاقل منطقة رئيسية واحدة']);
        if(isset($id) && $id != 0){
            $mainarea = Mainarea::find($id);
            return view('managers.sales.addSubArea')->with('mainarea',$mainarea);
        }
        return view('managers.sales.addSubArea', compact('mainareas',$mainareas));
    }
    public function storeSubArea(Request $request,$id)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $mainarea_id = $id;
        if($id == 0)
            $mainarea_id = $request->mainarea_id;
        Subarea::create([
            'name_sub_area' => $request->name_sub_area,
            'mainarea_id' => $mainarea_id,
        ]);   
        if(isset($id) && $id != 0)
            return redirect('/managerSales/supAreas/'.$id)->with('status','تم إضافة البيانات بشكل ناجح');
        return redirect('/managerSales/manageSubAreas')->with('status','تم إضافة البيانات بشكل ناجح');
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
            'name_sub_area.unique' => 'هذه المنطقة موجوده مسبقاً، ادخل منطقة أخرى',
            'name_sub_area.string' => 'يجب ان يكون هذا الحقل على شكل نص وليس رقماً',
        ];
    }
    public function editSubArea($id)
    {
        $subarea = Subarea::find($id);
        if(!$subarea)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $mainarea = Mainarea::find($subarea->mainarea_id);
        $mainareas = Mainarea::all();
        return view('managers.sales.editSubArea', compact('subarea',$subarea))->with('mainarea',$mainarea)
        ->with('mainareas',$mainareas);
    }
    public function UpdateSubArea(Request $request,$id)
    {
        $rules = [ 'name_sub_area' => 'required|string', ];
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $subarea = Subarea::find($id);
        if($subarea->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $subarea->name_sub_area = $request->Input('name_sub_area');
        $subarea->mainarea_id = $request->mainrea_id;
        $subarea->update();

        return redirect('/managerSales/manageSubAreas')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteSubArea($id)
    {
        $subarea = Subarea::find($id);
        if($subarea->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $subarea->delete();
        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
    }
    
    public function showRepresentatives($id)
    {
        $subarea = Subarea::find($id);
        $reps = $subarea->representatives;
        return view('managers.sales.representativesSubArea', compact('subarea',$subarea))->with('reps',$reps);
    }
}
