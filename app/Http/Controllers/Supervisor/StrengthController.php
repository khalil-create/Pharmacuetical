<?php

namespace App\Http\Controllers\Supervisor;
use App\Http\Controllers\Controller;
use App\Models\Strengthspromotion;
use App\Models\Study;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class StrengthController extends Controller
{
    public function getStudyStrengths($id)
    {
        $study = Study::with('strengths')->find($id);
        if(!$study)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $strengths = $study->strengths;
        return view('supervisors.strengthsStudy')->with('study',$study);
    }
    public function addStrength($id)
    {
        return view('supervisors.addStrength')->with('id',$id);
    }
    public function storeStrength(Request $request)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $strength = Strengthspromotion::create([
            'strength' => $request->strength,
            'study_id' => $request->id,
        ]); 
        return redirect('/supervisor/studyStrengths/'.$request->id)->with('status','تم إضافة البيانات بشكل ناجح');
    }
    protected function getRules()
    {
        return $rules =  [
            'strength' => 'required|string|max:255',
        ];
    }
    protected function getMessages()
    {
        return $messages = [
            'strength.required' => 'يجب عليك كتابة النقطة الترويجية',
        ];
    }
    // public function addStrengthsExist($id)
    // {
    //     $strengths = Strengthspromotion::all();
    //     return view('admin.addStrengthsExist')->with('strengths',$strengths)->with('id',$id);
    // }
    // public function storeStrengthsExist(Request $request)
    // {
    //     $validator = Validator::make($request->all(),
    //     ['strengthsIds' => 'required',],
    //     ['strengthsIds.required' => 'يجب عليك اختيار على الاقل نقطة واحده',]);
    //     if($validator->fails()){
    //         return redirect()->back()->withErrors($validator)->withInputs($request->all());
    //     }
    //     return $request->strengthsIds;
    //     $item = Item::find($request->id);
    //     $item->uses()->syncWithoutDetaching($request->usesIds);
    //     return redirect('/itemUses/'.$request->id)->with('status','تم إضافة البيانات بشكل ناجح');
    // }
    public function editStrength($id)
    {
        $strength = Strengthspromotion::find($id);
        return view('supervisors.editStrength')->with('strength',$strength);
    }
    public function updateStrength(Request $request,$id)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $str = Strengthspromotion::find($id);
        if($str->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $str->strength = $request->strength;
        $str->update();
        return redirect('/supervisor/studyStrengths/'.$str->study_id)->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteStrength($id)
    {
        $str = Strengthspromotion::find($id);
        if(!$str)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $str->delete();
        return redirect('/supervisor/studyStrengths/'.$str->study_id)->with('status','تم حذف البيانات بشكل ناجح');
    }
}
