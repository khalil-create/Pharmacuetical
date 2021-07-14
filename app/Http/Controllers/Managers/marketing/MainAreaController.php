<?php

namespace App\Http\Controllers\managers\Marketing;
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
        return view('Managers.marketing.manageMainAreas',compact('mainareas',$mainareas));
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////
    public function addMainArea()
    {
        $supervisor = User::whereHas('supervisor')->get();
        return view('Managers.marketing.addMainArea', compact('supervisor',$supervisor));
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
        return redirect('/managerMarketing/manageMainAreas')->with('status','تم إضافة البيانات بشكل ناجح');
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function getRules()
    {
        return $rules = [
                'name_main_area' => 'required|string|max:255|unique:mainareas',
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
        $supervisor = Supervisor::findOrfail($area->supervisor_id);
        // $supervisor = $sup1->user()->get();
        $supervisors = Supervisor::whereHas('user')->get();
        // return $supervisors;
        return view('Managers.marketing.editMainArea', compact('supervisor',$supervisor))->with('supervisors',$supervisors)
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
        $sup = Supervisor::find($request->supervisor_id);
        $mainArea->name_main_area = $request->Input('name_main_area');
        $mainArea->supervisor_id = $sup->id;
        $mainArea->update();

        return redirect('/managerMarketing/manageMainAreas')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteMainArea($id)
    {
        $mainarea = Mainarea::findOrfail($id);
        if(!$mainarea)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $mainarea->delete();

        return redirect('/managerMarketing/manageMainAreas')->with('status','تم حذف البيانات بشكل ناجح');
    }
    public function getSupAreasForMainArea($id)
    {
        $mainarea = Mainarea::find($id);
        if(!$mainarea)
            return redirect()->back()->with('exist',0)->with(['error' => 'هذه البيانات غير موجوده ']);
        $subareas = Subarea::where('mainarea_id',$mainarea->id)->get();
        if(isset($subareas) && $subareas->count() > 0){
            return view('Managers.marketing.mainAreaHasSubArea')->with('mainarea',$mainarea)->with('exist',1)->with('subareas',$subareas);
        }
        else{
            return view('Managers.marketing.mainAreaHasSubArea')->with('mainarea',$mainarea)->with('exist',0)->with('subareas',$subareas);
        }
    }
}
