<?php

namespace App\Http\Controllers\Supervisor;
use App\Models\Task;
use App\Models\Supervisor;
use App\Http\Controllers\Controller;
use App\Models\Representative;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\userTrait;

class TaskController extends Controller
{
    use userTrait;
    public function getAllChargedTasks()
    {
        $tasks = Task::whereHas('supervisor')->where('manager_id','!=',null)->get();
        return view('supervisors.manageChargedTasks',compact('tasks',$tasks));
    }
    public function performTask($id)
    {
        $task = Task::findOrfail($id);
        return view('supervisors.performTask',compact('task'));
    }
    public function storePerformTask(Request $request,$id)
    {
        $task = Task::findOrfail($id);
        if($request->hasfile('report_task_file'))
        {
            $file_name = $this->saveImage($request->file('report_task_file'),'reports/tasks/');
            $task->report_task = $file_name;
        }
        else{
            $task->report_task = $request->report_task_text;
        }
        $task->performed = 1;
        $task->update();

        return redirect('/supervisor/manageChargedTasks')->with('status','تم اضافة تقرير انجاز المهمة بشكل ناجح');
    }
    public function getAllDistributedTasks()
    {
        $tasks = Task::whereHas('supervisor')->where('representative_id','!=',null)->get();
        return view('supervisors.manageDistributedTasks',compact('tasks',$tasks));
    }
    public function addDistributedTask()
    {
        $reps = Representative::with('user')->where('supervisor_id',Auth::user()->supervisor->id)->get();
        if($reps->count() < 1)
            return redirect()->back()->with(['error' => 'لايوجد لديك مناديب لإضافة مهمة']);
        return view('supervisors.addDistributedTask',compact('reps'));
    }
    public function storeDistributedTask(Request $request)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        // return $request->manager_id;
        Task::create([
            'task_title' => $request->task_title,
            'description' => $request->description,
            'last_date' => $request->last_date,
            'performed' => 0,
            'supervisor_id' => Auth::user()->supervisor->id,
            'representative_id' => $request->representative_id,
        ]);
        return redirect('/supervisor/manageDistributedTasks')->with('status','تم إضافة المهمة بشكل ناجح');
    }
    protected function getRules()
    {
        return $rules = [
                'task_title' => 'required|string|max:255',
                'description' => 'required|string',
                'last_date' => 'required|max:255',
            ];
    }
    protected function getMessages()
    {
        return $messages = [
            'task_title.required' => 'يجب عليك كتابة اسم المهمه',
            'description.required' => 'يجب عليك كتابة الوصف',
            'last_date.required' => 'يجب عليك كتابة التأريخ',
        ];
    }
    public function editDistributedTask($id)
    {
        $task = Task::find($id);
        if(!$task)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده']);
        
        $reps = Representative::with('user')->where('supervisor_id',Auth::user()->supervisor->id)->get();
        return view('supervisors.editDistributedTask',compact('reps'))->with('task',$task);
    }
    public function updateDistributedTask(Request $request,$id)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $task = Task::find($id);
        $task->task_title = $request->task_title;
        $task->description = $request->description;
        $task->last_date = $request->last_date;
        $task->representative_id = $request->representative_id;
        $task->update();

        return redirect('/supervisor/manageDistributedTasks')->with('status','تم تعديل المهمة بشكل ناجح');
    }
    public function deleteDistributedTask($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect('/supervisor/manageDistributedTasks')->with('status','تم حذف المهمة بشكل ناجح');
    }
}
