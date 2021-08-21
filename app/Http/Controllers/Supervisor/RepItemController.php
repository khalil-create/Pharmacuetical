<?php

namespace App\Http\Controllers\Supervisor;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Item;
use App\Http\Controllers\Controller;
use App\Models\Representative;
use App\Models\Supervisor;
use App\Models\Company;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RepItemController extends Controller
{
    public function getAllRepItems()
    {
        $reps = Representative::where('supervisor_id',Auth::user()->supervisor->id)->get();
        return view('supervisors.manageRepItems',compact('reps'));
    }
    public function editRepItems($id)
    {
        $rep = Representative::findOrfail($id); 
        if($rep->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $companies = Company::where('supervisor_id',Auth::user()->supervisor->id)->get();
        // return $companies;
        return view('supervisors.editRepItems', compact('companies'))->with('rep',$rep);
    }
    public function UpdateRepItem(Request $request,$id)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $rep = Representative::find($id);
        
        if($rep->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $rep->items()->sync($request->items_ids);
        return redirect('/supervisor/manageRepItems')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    protected function getRules()
    {
        return $rules = [
                'items_ids' => 'required',
            ];
    }
    protected function getMessages()
    {
        return $messages = [
            'items_ids.required' => 'يجب عليك اختيار على الاقل صنف واحد',
        ];
    }
    // public function deleteRepItem($id)
    // {
    //     $RepItem = Item::find($id);
    //     if($RepItem->count() < 1)
    //         return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
    //     $RepItem->delete();
    //     return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
    //     // return redirect('/supervisor/manageRepItem')->with('status','تم حذف البيانات بشكل ناجح');
    // }
}
