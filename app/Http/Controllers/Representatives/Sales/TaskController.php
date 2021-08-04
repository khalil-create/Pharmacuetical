<?php

namespace App\Http\Controllers\Representatives\Sales;
use App\Models\Task;
use App\Models\Supervisor;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Representative;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\userTrait;

class TaskController extends Controller
{
    use userTrait;
    public function getAllChargedTasks(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        $tasks = Task::where('representative_id', Auth::user()->representatives->id)->whereNotNull('manager_id')->get();
        return view('representatives.repSales.showChargedTasks',compact('tasks',$tasks));
    }
    public function performTask($id)
    {
        $task = Task::findOrfail($id);
        return view('representatives.repSales.performTask',compact('task'))->with(['error' => 'انتبه يجب عليك تعبئة حقل واحد فقط، إما كتابة تقرير بشكل نصي او يمكنك تحميل ملف تقريرك اذا كان يشتمل على نص كبير']);
    }
    public function storePerformTask(Request $request,$id)
    {
        $task = Task::findOrfail($id);
        if($task->report_task){
            $report = $task->report_task;
            $index = strpos($report,'.');
            $isFile = substr($report,$index + 1);
            if($isFile == 'pdf' || $isFile == 'xlsx' || $isFile == 'docx')
                $File = true;
            else 
                $File = false;
        }
        if($task->report_task == null)  //add file or text report
        {
            if($request->hasfile('report_task_file')){
                $file_name = $this->saveImage($request->file('report_task_file'),'reports/tasks/');
                $task->report_task = $file_name;
            }
            else
                $task->report_task = $request->report_task_text;
        }
        else{   //delete file or update file
            if($request->hasfile('report_task_file') && $File){
                $this->deleteFile($task->report_task,'reports/tasks/');//delete old file
                $file_name = $this->saveImage($request->file('report_task_file'),'reports/tasks/');//upload new file
                $task->report_task = $file_name;//save name file in DB
            }
            else if($request->hasfile('report_task_file') && !$File){
                //no old file to delete
                $file_name = $this->saveImage($request->file('report_task_file'),'reports/tasks/');//upload new file
                $task->report_task = $file_name;//save name file in DB
            }
            else if(!$request->hasfile('report_task_file') && $File){
                $this->deleteFile($task->report_task,'reports/tasks/');//delete old file
                $task->report_task = $request->report_task_text;//save text report rather old file
            }
            else{   //no old file and no new file
                $task->report_task = $request->report_task_text;//save text report rather old text report
            }
        }
        $task->performed = 1;
        $task->update();
        ////////////////////// Notify user ///////////////////////////
        $user = User::where('user_type','مدير مبيعات')->first();
        $this->notifyUser('مهام','تم انجاز مهمة',$user->id);
        return redirect('/repSales/showChargedTasks')->with('status','تم اضافة تقرير انجاز المهمة بشكل ناجح');
    }
}
