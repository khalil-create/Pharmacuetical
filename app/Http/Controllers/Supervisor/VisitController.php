<?php

namespace App\Http\Controllers\Supervisor;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Visit;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use App\Traits\userTrait;
class VisitController extends Controller
{
    use userTrait;
    public function getAllVisits(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        $supervisor = Supervisor::findOrfail(Auth::user()->supervisor->id);
        return view('supervisors.manageVisits',compact('supervisor'));
    }
    public function deleteVisit($id)
    {
        $visit = Visit::findOrfail($id);
        if($visit->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $visit->delete();

        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
        // return redirect('/supervisor/manageVisits')->with('status','تم حذف البيانات بشكل ناجح');
    }
    public function showVisitDetails($id)
    {
        $visit = Visit::findOrfail($id);
        if($visit->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        return view('supervisors.showVisitDetails',compact('visit'));
    }
}
