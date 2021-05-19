<?php

namespace App\Http\Controllers\Admin;
use App\Models\Mainarea;
use App\Models\User;
use App\Models\Supervisor;
use App\Models\Subarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class MainAreaController extends Controller
{
    public function getAllAreas()
    {
        $mainareas = Mainarea::whereHas('supervisor')->get();
        return view('admin.manageMainAreas',compact('mainareas',$mainareas));
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////
    public function addMainArea()
    {
        $supervisor = User::whereHas('supervisor')->get();
        return view('admin.addMainArea', compact('supervisor',$supervisor));
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////
    public function storeMainArea(Request $request)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $user = User::where('user_name_third',$request->supervisor_name)->first();
        $supervisor = Supervisor::where('user_id',$user->id)->first();
        Mainarea::create([
            'name_main_area' => $request->name_main_area,
            'supervisor_id' => $supervisor->id,
        ]);        
        return redirect('/manageMainAreas')->with('status','تم إضافة البيانات بشكل ناجح');
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function getRules()
    {
        return $rules = [
                'name_main_area' => 'required|string|max:255',
            ];
    }
    protected function getMessages()
    {
        return $messages = [
            'name_main_area.required' => 'يجب عليك كتابة المنطقة الرئيسية',
        ];
    }
    public function editMainArea($areaid)
    {
        $area = Mainarea::find($areaid); 
        if($area->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $sup1 = Supervisor::findOrfail($area->supervisor_id);
        $supervisor = $sup1->user()->get();
        $supervisors = User::whereHas('supervisor')->get();
        return view('admin.editMainArea', compact('supervisor',$supervisor))->with('supervisors',$supervisors)
        ->with('area',$area);
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function UpdateMainArea(Request $request,$areaid)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $mainArea = Mainarea::find($areaid);
        
        if($mainArea->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $supervisorName = $request->Input('supervisor_name');
        $user = User::where('user_name_third',$supervisorName)->first();
        $sup = $user->supervisor()->get();
        $supID = 0;
        foreach($sup as $s){
            $supID = $s->id;
        }
        $mainArea->name_main_area = $request->Input('name_main_area');
        $mainArea->supervisor_id = $supID;
        $mainArea->update();

        return redirect('/manageMainAreas')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteMainArea($id)
    {
        $mainarea = Mainarea::findOrfail($id);
        if(!$mainarea)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $mainarea->subareas()->delete();
        $mainarea->delete();

        return redirect('/manageMainAreas')->with('status','تم حذف البيانات بشكل ناجح');
    }
    public function getSupAreasForMainArea($id)
    {
        $mainarea = Mainarea::find($id);
        if(!$mainarea)
            return redirect()->back()->with('exist',0)->with(['error' => 'هذه البيانات غير موجوده ']);
        $subareas = Subarea::where('mainarea_id',$mainarea->id)->get();
        if(isset($subareas) && $subareas->count() > 0){
            return view('admin.mainAreaHasSubArea')->with('mainarea',$mainarea)->with('exist',1)->with('subareas',$subareas);
        }
        else{
            return view('admin.mainAreaHasSubArea')->with('mainarea',$mainarea)->with('exist',0)->with('subareas',$subareas);
        }
    }
}
