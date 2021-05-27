<?php

namespace App\Http\Controllers\Admin;
use App\Models\Task;
use App\Models\Manager;
use App\Models\Supervisor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function getAllTasks()
    {
        $tasks = Task::get();
        return view('admin.manageTasks',compact('tasks',$tasks));
    }
    public function addTask()
    {
        $managers = Manager::with('user')->get();
        $supervisors = Supervisor::whereHas('user')->get();
        return view('admin.addTask',compact('managers',$managers))->with('supervisors',$supervisors);
    }
    public function storeTask(Request $request)
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
            'manager_id' => $request->manager_id,
            'supervisor_id' => $request->supervisor_id,
        ]);
        return redirect('/manageTasks')->with('status','تم إضافة البيانات بشكل ناجح');
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
    public function editTask($id)
    {
        $task = Task::find($id);
        if(!$task)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده']);
        
        $managers = Manager::with('user')->get();
        $supervisors = Supervisor::whereHas('user')->get();
        return view('admin.editTask',compact('task',$task))->
        with('managers',$managers)->with('supervisors',$supervisors);
    }
    public function updateTask(Request $request,$id)
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
        $task->manager_id = $request->manager_id;
        $task->supervisor_id = $request->supervisor_id;
        $task->update();

        return redirect('/manageTasks')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteTask($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect('/manageTasks')->with('status','تم حذف البيانات بشكل ناجح');
    }
}
