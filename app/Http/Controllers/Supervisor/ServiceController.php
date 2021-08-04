<?php

namespace App\Http\Controllers\Supervisor;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\userTrait;
class ServiceController extends Controller
{
    use userTrait;
    public function getAllServices(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        $supervisor = Supervisor::findOrfail(Auth::user()->supervisor->id);
        return view('supervisors.manageServices',compact('supervisor'));
    }
    public function activateService($id)
    {
        $service = Service::findOrfail($id);
        if($service->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $service->statues = true;
        $service->update();
        ////////////////// Notify user //////////////////
        $user_id = $service->representative->user->id;
        $this->notifyUser('خدمات','تم قبول الخدمة',$user_id);
        return redirect('/supervisor/manageServices')->with('status','تم قبول الخدمة');
    }
    public function notActivateService($id)
    {
        $service = Service::findOrfail($id);
        if($service->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $service->statues = false;
        $service->update();
        ////////////////// Notify user //////////////////
        $user_id = $service->represntaitives->user->id;
        $this->notifyUser('خدمات','تم رفض الخدمة',$user_id);
        return redirect('/supervisor/manageServices')->with('status','تم إالغاء تفعيل الخدمة');
    }
}
