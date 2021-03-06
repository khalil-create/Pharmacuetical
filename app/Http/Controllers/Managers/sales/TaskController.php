<?php

namespace App\Http\Controllers\Managers\Sales;
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
    // public function getAllTasks()
    // {
    //     $tasks = Task::where('supervisor_id', Auth::user()->supervisor->id)->whereNotNull('manager_id')->get();
    //     return view('managers.sales.manageChargedTasks',compact('tasks',$tasks));
    // }
    // public function performTask($id)
    // {
    //     $task = Task::findOrfail($id);
    //     return view('managers.sales.performTask',compact('task'));
    // }
    // public function storePerformTask(Request $request,$id)
    // {
    //     $task = Task::findOrfail($id);
    //     if($task->report_task){
    //         $report = $task->report_task;
    //         $index = strpos($report,'.');
    //         $isFile = substr($report,$index + 1);
    //         if($isFile == 'pdf' || $isFile == 'xlsx' || $isFile == 'docx')
    //             $File = true;
    //         else 
    //             $File = false;
    //     }
    //     if($task->report_task == null)  //add file or text report
    //     {
    //         if($request->hasfile('report_task_file')){
    //             $file_name = $this->saveImage($request->file('report_task_file'),'reports/tasks/');
    //             $task->report_task = $file_name;
    //         }
    //         else
    //             $task->report_task = $request->report_task_text;
    //     }
    //     else{   //delete file or update file
    //         if($request->hasfile('report_task_file') && $File){
    //             $this->deleteFile($task->report_task,'reports/tasks/');//delete old file
    //             $file_name = $this->saveImage($request->file('report_task_file'),'reports/tasks/');//upload new file
    //             $task->report_task = $file_name;//save name file in DB
    //         }
    //         else if($request->hasfile('report_task_file') && !$File){
    //             //no old file to delete
    //             $file_name = $this->saveImage($request->file('report_task_file'),'reports/tasks/');//upload new file
    //             $task->report_task = $file_name;//save name file in DB
    //         }
    //         else if(!$request->hasfile('report_task_file') && $File){
    //             $this->deleteFile($task->report_task,'reports/tasks/');//delete old file
    //             $task->report_task = $request->report_task_text;//save text report rather old file
    //         }
    //         else{   //no old file and no new file
    //             $task->report_task = $request->report_task_text;//save text report rather old text report
    //         }
    //     }
    //     $task->performed = 1;
    //     $task->update();

    //     return redirect('/managerSalesmanageChargedTasks')->with('status','???? ?????????? ?????????? ?????????? ???????????? ???????? ????????');
    // }
    public function getAllTasks(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        $tasks = Task::where('manager_id', Auth::user()->manager->id)->where('representative_id','!=',null)->get();
        return view('managers.sales.manageTasks',compact('tasks',$tasks));
    }
    public function addTask()
    {
        $reps = Representative::with('user')->where('manager_id',Auth::user()->manager->id)->get();
        if($reps->count() < 1)
            return redirect()->back()->with(['error' => '???????????? ???????? ???????????? ???????????? ????????']);
        return view('managers.sales.addTask',compact('reps'));
    }
    public function storeTask(Request $request)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $rep_id = $request->representative_id;
        Task::create([
            'task_title' => $request->task_title,
            'description' => $request->description,
            'last_date' => $request->last_date,
            'performed' => 0,
            'manager_id' => Auth::user()->manager->id,
            'representative_id' => $request->representative_id,
        ]);
        ////////////// Notify user //////////////////////
        $rep = Representative::findOrfail($rep_id);
        $this->notifyUser('????????','???????? ???????? ??????????',$rep->user->id);
        return redirect('/managerSales/manageTasks')->with('status','???? ?????????? ???????????? ???????? ????????');
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
            'task_title.required' => '?????? ???????? ?????????? ?????? ????????????',
            'description.required' => '?????? ???????? ?????????? ??????????',
            'last_date.required' => '?????? ???????? ?????????? ??????????????',
        ];
    }
    public function editTask($id)
    {
        $task = Task::find($id);
        if(!$task)
            return redirect()->back()->with(['error' => '?????? ???????????????? ?????? ????????????']);
        
        $reps = Representative::with('user')->where('manager_id',Auth::user()->manager->id)->get();
        return view('managers.sales.editTask',compact('reps'))->with('task',$task);
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
        $task->representative_id = $request->representative_id;
        $task->update();
        
        return redirect('/managerSales/manageTasks')->with('status','???? ?????????? ???????????? ???????? ????????');
    }
    public function deleteTask($id)
    {
        $task = Task::find($id);
        $task->delete();
        return response()->json(['status' => '???? ?????? ???????????????? ???????? ????????']);
        // return redirect('/managerSales/manageDistributedTasks')->with('status','???? ?????? ???????????? ???????? ????????');
    }
}
