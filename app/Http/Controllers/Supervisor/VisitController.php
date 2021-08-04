<?php

namespace App\Http\Controllers\Supervisor;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Doctor;
use App\Models\OfferService;
use App\Models\ProblemsSolve;
use App\Models\Visit;
use App\Models\Service;
use App\Models\representative;
use App\Models\User;
use App\Models\Supervisor;
use App\Models\VisitComposition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
}
