<?php

namespace App\Http\Controllers\Representatives\Science;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Study;
use App\Models\Supervisor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Traits\userTrait;

class StudyController extends Controller
{
    use userTrait;
    public function getAllStudies(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        $studies = Study::where('supervisor_id',Auth::user()->representatives->supervisor_id)->get();
        return view('representatives.repScience.showStudies',compact('studies',$studies));
    }
    // public function addStudy()
    // {
    //     // $supervisor = Supervisor::whereHas('user')->get();
    //     return view('supervisors.addStudy');
    // }
    // public function storeStudy(Request $request)
    // {
    //     $rules = $this->getRules();
    //     $messages = $this->getMessages();
    //     $validator = Validator::make($request->all(),$rules,$messages);
    //     if($validator->fails()){
    //         return redirect()->back()->withErrors($validator)->withInputs($request->all());
    //     }
    //     $study = Study::create([
    //         'title' => $request->title,
    //         'source' => $request->source,
    //         'emission_date' => $request->emission_date,
    //         'supervisor_id' => Auth::user()->supervisor->id,
    //     ]);
    //     return redirect('/supervisor/manageStudies')->with('status','تم إضافة البيانات بشكل ناجح');
    // }
    // protected function getRules()
    // {
    //     return $rules = [
    //             'title' => 'required|string|max:255',
    //             'source' => 'required|string|max:255',
    //             'emission_date' => 'required',
    //         ];
    // }
    // protected function getMessages()
    // {
    //     return $messages = [
    //         'title.required' => 'يجب عليك كتابة عنوان الدراسة',
    //         'source.required' => 'يجب عليك كتابة الجهة المحكمة',
    //         'emission_date.required' => 'يجب عليك كتبة سنة الاصدار  ',
    //     ];
    // }
    // public function editStudy($id)
    // {
    //     $study = Study::find($id); 
    //     if(!$study)
    //         return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
    //     $supervisors = Supervisor::whereHas('user')->get();
    //     return view('supervisors.editStudy', compact('study',$study))->with('supervisors',$supervisors);
    // }
    // public function UpdateStudy(Request $request,$id)
    // {
    //     $study = Study::findOrfail($id);
    //     if($study->count() < 1)
    //         return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
    //     $study->title = $request->title;
    //     $study->source = $request->source;
    //     $study->emission_date = $request->emission_date;
    //     $study->update();
    //     return redirect('/supervisor/manageStudies')->with('status','تم تعديل البيانات بشكل ناجح');
    // }
    // public function deleteStudy($id)
    // {
    //     $study = Study::findOrfail($id);
    //     if(!$study)
    //         return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
    //     // return $study->strengths;
    //     $study->strengths()->delete();
    //     $study->delete();

    //     return redirect('/supervisor/manageStudies')->with('status','تم حذف البيانات بشكل ناجح');
    // }
    // public function getStudyStrengths($id)
    // {
    //     $study = Study::with('strengths')->find($id);
    //     if(!$study)
    //         return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
    //     $strengths = $study->strengths;
    //     return view('supervisors.strengthsStudy')->with('study',$study);
    // }
}
