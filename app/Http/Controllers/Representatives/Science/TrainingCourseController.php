<?php
namespace App\Http\Controllers\Representatives\Science;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\TrainingCourse;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Traits\userTrait;

class TrainingCourseController extends Controller
{
    use userTrait;
    public function getAllCourses(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        $courses = TrainingCourse::where('supervisor_id',Auth::user()->representatives  ->supervisor_id)->get();
        return view('representatives.repScience.manageTrainingCourses',compact('courses'));
    }
    // public function addCourse()
    // {
    //     $items = Item::all();
    //     if($items->count() < 1)
    //         return redirect()->back()->with('error','لايمكنك اضافة برنامج تدريبي ولم يتم اضافة على الأقل صنف واحد');
    //     return view('representatives.repScience.addCourse', compact('items'));
    // }
    // public function storeCourse(Request $request)
    // {
    //     $rules = $this->getRules();
    //     $messages = $this->getMessages();
    //     $validator = Validator::make($request->all(),$rules,$messages);
    //     if($validator->fails()){
    //         return redirect()->back()->withErrors($validator)->withInputs($request->all());
    //     }
    //     if($request->type == 1){
    //         if(!$request->hasfile('important_points_file'))
    //             return redirect()->back()->with('error','يجب عليك تحميل الملف');
    //         $points = $this->saveImage($request->file('important_points_file'),'reports/courses/');
    //     }
    //     else if($request->type == 2){
    //         $points = $request->important_points_link;
    //         if(substr($points,0,5) != 'https')
    //             return redirect()->back()->with('error','يجب ان يبدأ رابط الفيديو بـ https://you.bu/');
    //     }
    //     else{
    //         $points = '';
    //         return redirect()->back()->with('error','يجب عليك اختيار نوع أهم المحاور إما ملف او رابط');
    //     }
    //     TrainingCourse::create([
    //         'title' => $request->title,
    //         'important_points' => $points,
    //         'representative_id' => Auth::user()->representative->id,
    //         'item_id' => $request->item_id,
    //     ]);
    //     return redirect('/repScience/manageTrainingCourses')->with('status','تم إضافة البيانات بشكل ناجح');
    // }
    // protected function getRules()
    // {
    //     return $rules = [
    //             'title' => 'required',
    //             'important_points_link' => 'required',
    //         ];
    // }
    // protected function getMessages()
    // {
    //     return $messages = [
    //         'title.required' => 'يجب عليك كتابة عنوان البرنامج التدريبي',
    //         'important_points_link.required' => 'يجب عليك كتابة هذا الحقل',
    //     ];
    // }
    // public function editCourse($id)
    // {
    //     $course = TrainingCourse::findOrfail($id);
    //     if($course->count() < 1)
    //         return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
    //     $items = Item::all();
    //     return view('representatives.editCourse', compact('course'))->with('items',$items);
    // }
    // public function updateCourse(Request $request,$id)
    // {
    //     $rules = $this->getRules();
    //     $messages = $this->getMessages();
    //     $validator = Validator::make($request->all(),$rules,$messages);
    //     if($validator->fails()){
    //         return redirect()->back()->withErrors($validator)->withInputs($request->all());
    //     }

    //     $course = TrainingCourse::find($id);
    //     if($course->count() < 1)
    //         return redirect()->back()->with('error','هذه البيانات غير موجوده ');
        
    //     $points = $course->important_points;
    //     $wasLinked = substr($points,0,5) == 'https' ? true:false;
    //     if($request->type == 1 && !$wasLinked && $request->hasfile('important_points_file'))
    //     {
    //         $this->deleteFile($course->important_points,'reports/courses/');
    //         $file_name = $this->saveImage($request->file('important_points_file'),'reports/courses/');
    //         $course->important_points = $file_name;
    //     }
    //     else if($request->type == 1 && $wasLinked && $request->hasfile('important_points_file')){
    //         $file_name = $this->saveImage($request->file('important_points_file'),'reports/courses/');
    //         $course->important_points = $file_name;
    //     }
    //     else if($request->type == 2 && !$wasLinked){
    //         $points = $request->important_points_link;
    //         if(substr($points,0,5) != 'https')
    //             return redirect()->back()->with('error','يجب ان يبدأ رابط الفيديو بـ https://you.bu/');

    //         $this->deleteFile($course->important_points,'reports/courses/');
    //         $course->important_points = $request->important_points_link;
    //     }
    //     else if($request->type == 2 && $wasLinked){
    //         $points = $request->important_points_link;
    //         if(substr($points,0,5) != 'https')
    //             return redirect()->back()->with('error','يجب ان يبدأ رابط الفيديو بـ https://you.bu/');
                
    //         $course->important_points = $request->important_points_link;
    //     }
    //     else if($request->hasfile('important_points_file')){
    //         return redirect()->back()->with('error','يجب عليك اختيار نوع أهم المحاور إما ملف او رابط');
    //     }
    //     $course->title = $request->title;
    //     $course->item_id = $request->item_id;
    //     $course->representative_id = Auth::user()->representative->id;
    //     $course->update();

    //     return redirect('/repScience/manageTrainingCourses')->with('status','تم تعديل البيانات بشكل ناجح');
    // }
    // public function deleteCourse($id)
    // {
    //     $course = TrainingCourse::find($id);
    //     if($course->count() < 1)
    //         return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
    //     $this->deleteFile($course->important_points,'reports/courses/');
    //     $course->delete();
    //     return redirect('/repScience/manageTrainingCourses')->with('status','تم حذف البيانات بشكل ناجح');
    // }
}
