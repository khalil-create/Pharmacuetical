<?php

namespace App\Http\Controllers\Supervisor;
use Illuminate\Support\Facades\Auth;
use App\Models\Mainarea;
use App\Models\User;
use App\Models\Supervisor;
use App\Models\Subarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Representative;
use App\Models\RepresentativeTest;
use App\Traits\userTrait;

class MainAreaController extends Controller
{
    use userTrait;
    public function getAllAreas(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        $mainareas = Mainarea::where('supervisor_id',Auth::user()->supervisor->id)->get();
        return view('supervisors.manageMainAreas',compact('mainareas',$mainareas));
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////
    public function addMainArea()
    {
        // $supervisor = User::whereHas('supervisor')->get();
        // if($supervisor->count() < 1)
        //     return redirect()->back()->with(['error' => 'لايمكنك اضافة منطقة رئيسية قبل مايتم اضافة على الاقل مشرف واحد']);

        return view('supervisors.addMainArea');
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
        // $user = User::where('user_name_third',$request->supervisor_name)->first();
        // $supervisor = Supervisor::where('user_id',$user->id)->first();
        Mainarea::create([
            'name_main_area' => $request->name_main_area,
            'supervisor_id' => Auth::user()->supervisor->id,
        ]);        
        return redirect('/supervisor/manageMainAreas')->with('status','تم إضافة البيانات بشكل ناجح');
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
        // $supervisor = Supervisor::findOrfail($area->supervisor_id);
        // $supervisor = $sup1->user()->get();
        // $supervisors = Supervisor::whereHas('user')->get();
        // return $supervisors;
        return view('supervisors.editMainArea', compact('area'));
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
        // $sup = Supervisor::find($request->supervisor_id);
        $mainArea->name_main_area = $request->Input('name_main_area');
        $mainArea->supervisor_id = Auth::user()->supervisor->id;
        $mainArea->update();

        return redirect('/supervisor/manageMainAreas')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteMainArea($id)
    {
        $mainarea = Mainarea::findOrfail($id);
        if(!$mainarea)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $mainarea->delete();

        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
        // return redirect('/supervisor/manageMainAreas')->with('status','تم حذف البيانات بشكل ناجح');
    }
    public function getSupAreasForMainArea($id)
    {
        $mainarea = Mainarea::find($id);
        if(!$mainarea)
            return redirect()->back()->with('exist',0)->with(['error' => 'هذه البيانات غير موجوده ']);
        $subareas = Subarea::where('mainarea_id',$mainarea->id)->get();
        if(isset($subareas) && $subareas->count() > 0){
            return view('supervisors.mainAreaHasSubArea')->with('mainarea',$mainarea)->with('exist',1)->with('subareas',$subareas);
        }
        else{
            return view('supervisors.mainAreaHasSubArea')->with('mainarea',$mainarea)->with('exist',0)->with('subareas',$subareas);
        }
    }
    public function showMainareaDetails($id)
    {
        $mainarea = Mainarea::with(['representatives','subareas'])->findOrfail($id);
        if($mainarea->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        return view('supervisors.showMainareaDetails',compact('mainarea'));
    }
}
