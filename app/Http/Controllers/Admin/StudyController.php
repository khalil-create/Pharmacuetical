<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Study;
use App\Models\Supervisor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class StudyController extends Controller
{
    public function getAllStudies()
    {
        $studies = Study::whereHas('supervisor')->get();
        // if($studies->count() < 1 )
        //     return view('admin.manageStudies');
        return view('admin.manageStudies',compact('studies',$studies));
    }
    public function addStudy()
    {
        $supervisor = Supervisor::whereHas('user')->get();
        return view('admin.addStudy', compact('supervisor',$supervisor));
    }
    public function storeStudy(Request $request)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $study = Study::create([
            'title' => $request->title,
            'source' => $request->source,
            'emission_date' => $request->emission_date,
            'supervisor_id' => $request->supervisor_id,
        ]);
        return redirect('/admin/manageStudies')->with('status','تم إضافة البيانات بشكل ناجح');
    }
    protected function getRules()
    {
        return $rules = [
                'title' => 'required|string|max:255',
                'source' => 'required|string|max:255',
                'emission_date' => 'required',
            ];
    }
    protected function getMessages()
    {
        return $messages = [
            'title.required' => 'يجب عليك كتابة عنوان الدراسة',
            'source.required' => 'يجب عليك كتابة الجهة المحكمة',
            'emission_date.required' => 'يجب عليك كتبة سنة الاصدار  ',
        ];
    }
    public function editStudy($id)
    {
        $study = Study::find($id); 
        if(!$study)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $supervisors = Supervisor::whereHas('user')->get();
        return view('admin.editStudy', compact('study',$study))->with('supervisors',$supervisors);
    }
    public function UpdateStudy(Request $request,$id)
    {
        $study = Study::findOrfail($id);
        if($study->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $study->title = $request->title;
        $study->source = $request->source;
        $study->emission_date = $request->emission_date;
        $study->supervisor_id = $request->supervisor_id;
        $study->update();
        return redirect('/admin/manageStudies')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteStudy($id)
    {
        $study = Study::findOrfail($id);
        if(!$study)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        // return $study->strengths;
        $study->strengths()->delete();
        $study->delete();

        return redirect('/admin/manageStudies')->with('status','تم حذف البيانات بشكل ناجح');
    }
    public function getStudyStrengths($id)
    {
        $study = Study::with('strengths')->find($id);
        if(!$study)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $strengths = $study->strengths;
        return view('admin.strengthsStudy')->with('study',$study);
    }
}
