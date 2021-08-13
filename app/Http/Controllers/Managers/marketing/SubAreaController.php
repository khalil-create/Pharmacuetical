<?php

namespace App\Http\Controllers\managers\Marketing;

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

        if(!($subArea->count() > 0))
            return view('managers.Marketing.manageSubAreas')->with('status','لايوجد مناطق فرعية الرجاء اضافة منطقة فرعية');
        return view('managers.Marketing.manageSubAreas')->with('subArea',$subArea);
    }
    public function addSubArea($id){
        $mainareas = Mainarea::all();
        if(isset($id) && $id != 0){
            $mainarea = Mainarea::find($id);
            return view('managers.Marketing.addSubArea')->with('mainarea',$mainarea);
        }
        return view('managers.Marketing.addSubArea', compact('mainareas',$mainareas));
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
            return redirect('/managerMarketing/supAreas/'.$id)->with('status','تم إضافة البيانات بشكل ناجح');
        return redirect('/managerMarketing/manageSubAreas')->with('status','تم إضافة البيانات بشكل ناجح');
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
        return view('managers.Marketing.editSubArea', compact('subarea',$subarea))->with('mainarea',$mainarea)
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

        return redirect('/managerMarketing/manageSubAreas')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteSubArea($id)
    {
        $subarea = Subarea::find($id);
        if($subarea->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $subarea->delete();
        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
        // return redirect('/managerMarketing/manageSubAreas')->with('status','تم حذف البيانات بشكل ناجح');
    }
    public function showSubareaReps($id)
    {
        $subarea = Subarea::find($id);
        $reps = $subarea->representatives;
        return view('managers.marketing.showSubareaReps', compact('subarea',$subarea))->with('reps',$reps);
    }
    public function addSubareaReps($id)
    {
        $subarea = Subarea::find($id);
        $reps = Representative::all();
        if($reps->count() < 1)
            return redirect()->back()->with(['error' => 'لايوجد مندوبيين لـ إضافتهم، الرجاء قم بإضافة على الاقل مندوب واحد']);
        return view('managers.marketing.addSubareaReps', compact('subarea',$subarea))->with('reps',$reps);
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

        return redirect('/managerMarketing/showSubareaReps/'.$id)->with('status','تم اضافة المناطق للمندوب بشكل ناجح');
    }
}
