<?php
namespace App\Http\Controllers\Supervisor;
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
    public function getAllCourses()
    {
        $courses = TrainingCourse::where('supervisor_id',Auth::user()->supervisor->id)->get();
        return view('supervisors.manageTrainingCourses',compact('courses'));
    }
    public function addCourse()
    {
        $items = Item::all();
        if($items->count() < 1)
            return redirect()->back()->with('error','لايمكنك اضافة برنامج تدريبي ولم يتم اضافة على الأقل صنف واحد');
        return view('supervisors.addCourse', compact('items'));
    }
    public function storeCourse(Request $request)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        if($request->hasfile('important_points'))
        {
            $file_name = $this->saveImage($request->file('important_points'),'reports/courses/');
        }
        TrainingCourse::create([
            'title' => $request->title,
            'important_points' => $file_name,
            'supervisor_id' => Auth::user()->supervisor->id,
            'item_id' => $request->item_id,
        ]);
        return redirect('/supervisor/manageTrainingCourses')->with('status','تم إضافة البيانات بشكل ناجح');
    }
    protected function getRules()
    {
        return $rules = [
                'title' => 'required',
            ];
    }
    protected function getMessages()
    {
        return $messages = [
            'title.required' => 'يجب عليك كتابة عنوان البرنامج التدريبي',
        ];
    }
    public function editCourse($id)
    {
        $course = TrainingCourse::findOrfail($id);
        if($course->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $items = Item::all();
        return view('supervisors.editCourse', compact('course'))->with('items',$items);
    }
    public function updateCourse(Request $request,$id)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }

        $course = TrainingCourse::find($id);
        if($course->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        if($request->hasfile('important_points'))
        {
            $this->deleteFile($course->important_points,'reports/courses/');
            $file_name = $this->saveImage($request->file('important_points'),'reports/courses/');
            $course->important_points = $file_name;
        }
        $course->title = $request->title;
        $course->item_id = $request->item_id;
        $course->supervisor_id = Auth::user()->supervisor->id;
        $course->update();

        return redirect('/supervisor/manageTrainingCourses')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteCourse($id)
    {
        $course = TrainingCourse::find($id);
        if($course->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $this->deleteFile($course->important_points,'reports/courses/');
        $course->delete();
        return redirect('/supervisor/manageTrainingCourses')->with('status','تم حذف البيانات بشكل ناجح');
    }
}
