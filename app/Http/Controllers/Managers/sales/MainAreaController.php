<?php

namespace App\Http\Controllers\Managers\Sales;
use Illuminate\Support\Facades\Auth;
use App\Models\Mainarea;
use App\Models\User;
use App\Models\Subarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Representative;

class MainAreaController extends Controller
{
    public function getAllAreas(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        $mainareas = Mainarea::all();
        return view('managers.sales.manageMainAreas',compact('mainareas',$mainareas));
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////
    public function addMainArea()
    {
        $supervisors = User::whereHas('supervisor')->get();
        if($supervisors->count() < 1)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة منطقة رئيسية قبل مايتم اضافة على الاقل مشرف واحد']);

        return view('managers.sales.addMainArea',compact('supervisors'));
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
        
        Mainarea::create([
            'name_main_area' => $request->name_main_area,
            'supervisor_id' => $request->supervisor_id,
        ]);        
        return redirect('/managerSales/manageMainAreas')->with('status','تم إضافة البيانات بشكل ناجح');
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
            'name_main_area.unique' => 'هذه المنطقة موجودة مسبقا، ادخل منطقة أخرى ',
        ];
    }
    public function editMainArea($areaid)
    {
        $area = Mainarea::find($areaid); 
        if($area->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $supervisors = User::whereHas('supervisor')->get();
        return view('managers.sales.editMainArea', compact('area'))->with('supervisors',$supervisors);
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
        // $sup = managerSales::find($request->managerSales_id);
        $mainArea->name_main_area = $request->Input('name_main_area');
        $mainArea->supervisor_id = $request->supervisor_id;
        $mainArea->update();

        return redirect('/managerSales/manageMainAreas')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteMainArea($id)
    {
        $mainarea = Mainarea::findOrfail($id);
        if(!$mainarea)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $mainarea->delete();

        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
    }
    public function getSupAreasForMainArea($id)
    {
        $mainarea = Mainarea::find($id);
        if(!$mainarea)
            return redirect()->back()->with('exist',0)->with(['error' => 'هذه البيانات غير موجوده ']);
        $subareas = Subarea::where('mainarea_id',$mainarea->id)->get();
        // if(isset($subareas) && $subareas->count() > 0){
            return view('managers.sales.mainAreaHasSubArea')->with('mainarea',$mainarea)->with('subareas',$subareas);
        // }
        // else{
        //     return view('managers.sales.mainAreaHasSubArea')->with('mainarea',$mainarea)->with('exist',0)->with('subareas',$subareas);
        // }
    }
}
