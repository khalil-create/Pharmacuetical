<?php

namespace App\Http\Controllers\admin;
use App\Models\Mainarea;
use App\Models\User;
use App\Models\Supervisor;
use App\Models\Subarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Traits\userTrait;

class MainAreaController extends Controller
{
    use userTrait;
    public function getAllAreas(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        $mainareas = Mainarea::whereHas('supervisor')->get();
        return view('admin.manageMainAreas',compact('mainareas',$mainareas));
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////
    public function addMainArea()
    {
        $supervisor = Supervisor::whereHas('user')->get();
        if(!$supervisor)
            return redirect()->back()->with(['error' => 'لايمكنك اضافة منطقة رئيسيه قبل مايتم اضافة على الاقل مشرف واحد ']);
        return view('admin.addMainArea', compact('supervisor'));
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////
    public function storeMainArea(Request $request)
    {
        $request->validate([
            'name_main_area' => 'required|string|max:255|unique:mainareas',
        ]);
        Mainarea::create([
            'name_main_area' => $request->name_main_area,
            'supervisor_id' => $request->supervisor_id,
        ]);        
        return redirect('/admin/manageMainAreas')->with('status','تم إضافة البيانات بشكل ناجح');
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
            'name_main_area.string' => 'يجب عليك كتابة هذا الحقل بشكل نصي',
            'name_main_area.max' => 'يجب ان لاتتجاوز عدد الأحرف لأكثر من 255 حرفاً',
            'name_main_area.unique' => 'هذه المنطقة قد تم اضافتها مسبقاً',
        ];
    }
    public function editMainArea($areaid)
    {
        $area = Mainarea::find($areaid); 
        if($area->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $supervisors = Supervisor::whereHas('user')->get();
        // return $supervisors;
        return view('admin.editMainArea', compact('supervisors'))->with('area',$area);
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function UpdateMainArea(Request $request,$id)
    {
        $mainArea = Mainarea::find($id);
        if($mainArea->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $request->validate([
            'name_main_area' => 'required|string|max:255|unique:mainareas,email'.($id ? ",$id" : ''),
        ]);
        $mainArea->name_main_area = $request->Input('name_main_area');
        $mainArea->supervisor_id = $request->supervisor_id;
        $mainArea->update();

        return redirect('/admin/manageMainAreas')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteMainArea($id)
    {
        $mainarea = Mainarea::findOrfail($id);
        if(!$mainarea)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $mainarea->delete();

        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
        // return redirect('/admin/manageMainAreas')->with('status','تم حذف البيانات بشكل ناجح');
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
    public function showMainareaDetails($id)
    {
        $mainarea = Mainarea::with(['representatives','subareas'])->findOrfail($id);
        if($mainarea->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        return view('admin.showMainareaDetails',compact('mainarea'));
    }
}
