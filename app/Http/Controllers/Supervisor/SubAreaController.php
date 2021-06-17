<?php

namespace App\Http\Controllers\Supervisor;

use Illuminate\Http\Request;
use App\Models\Subarea;
use App\Models\User;
use App\Models\Supervisor;
use App\Models\Mainarea;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class SubAreaController extends Controller
{
    public function getAllSubArea(){
        $subArea = Subarea::with('mainarea')->get();

        if(!($subArea->count() > 0))
            return view('supervisors.manageSubAreas')->with('status','لايوجد مناطق فرعية الرجاء اضافة منطقة فرعية');
        return view('supervisors.manageSubAreas')->with('subArea',$subArea);
    }
    public function addSubArea($id){
        $mainareas = Mainarea::all();
        if(isset($id) && $id != 0){
            $mainarea = Mainarea::find($id);
            return view('supervisors.addSubArea')->with('mainarea',$mainarea);
        }
        return view('supervisors.addSubArea', compact('mainareas',$mainareas));
    }
    public function storeSubArea(Request $request,$id)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $mainarea = Mainarea::where('name_main_area',$request->name_main_area)->first();
        $subarea = Subarea::create([
            'name_sub_area' => $request->name_sub_area,
            'mainarea_id' =>$mainarea->id,
        ]);   
        if(isset($id) && $id != 0)
            return redirect('/supervisor/supAreas/'.$id)->with('status','تم إضافة البيانات بشكل ناجح');
        return redirect('/supervisor/manageSubAreas')->with('status','تم إضافة البيانات بشكل ناجح');
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
        ];
    }
    public function editSubArea($id)
    {
        $subarea = Subarea::find($id);
        if($subarea->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $mainarea = Mainarea::find($subarea->mainarea_id);
        $mainareas = Mainarea::all();
        return view('supervisors.editSubArea', compact('subarea',$subarea))->with('mainarea',$mainarea)
        ->with('mainareas',$mainareas);
    }
    public function UpdateSubArea(Request $request,$id)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $subarea = Subarea::find($id);
        if($subarea->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $mainarea = Mainarea::where('name_main_area',$request->name_main_area)->first();
        $subarea->name_sub_area = $request->Input('name_sub_area');
        $subarea->mainarea_id = $mainarea->id;
        $subarea->update();

        return redirect('/supervisor/manageSubAreas')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteSubArea($id)
    {
        $subarea = Subarea::find($id);
        if($subarea->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $subarea->delete();
        return redirect('/supervisor/manageSubAreas')->with('status','تم حذف البيانات بشكل ناجح');
    }
}
