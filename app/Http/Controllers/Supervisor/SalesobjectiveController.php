<?php

namespace App\Http\Controllers\Supervisor;
use App\Models\Salesobjective;
use App\Models\Item;
use App\Http\Controllers\Controller;
use App\Models\Representative;
use App\Models\Supervisor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesobjectiveController extends Controller
{
    public function home()
    {
        return view('managers.marketing.home');
    }
    public function getAllSalesObjectives()
    {
        $salesObjectives = Salesobjective::whereHas('supervisor')
        ->where('supervisor_id',Auth::user()->supervisor->id)->where('manager_id','!=',null)->get();
        return view('supervisors.manageSalesObjectives',compact('salesObjectives',$salesObjectives));
    }
    public function addDividedSalesObjective($id)
    {
        $salesObjective = Salesobjective::findOrfail($id);
        $items = Item::get();
        if($items->count() < 1)
            return redirect('/supervisors/displaySalesObjectiveReps/'.$id)->with('error','لايمكنك اضافة عينة ولم يتم اضافة على الأقل صنف واحد');
        $reps = Representative::where('supervisor_id',Auth::user()->supervisor->id)->get();
        return view('supervisors.addSalesObjective',compact('reps'))
        ->with('salesObjective',$salesObjective);
    }
    public function storeDividedSalesObjective(Request $request,$id)
    {
        $rules = [
            'objective' => 'required|numeric',
            'representative_id' => 'required|numeric|unique:salesobjectives',
        ];
        $messages = [
            'objective.required' => 'يجب عليك كتابة الهدف',
            'objective.numeric' => 'يجب ان يكون هذا الحقل عدداً',
            'representative_id.unique' => 'هذا المندوب قد تم اضافة هدف بيعي له',
        ];;
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $salesObjective = Salesobjective::findOrfail($id);
        Salesobjective::create([
            'objective' => $request->objective,
            'description' => $request->description,
            'supervisor_id' => Auth::user()->supervisor->id,
            'representative_id' => $request->representative_id,
            'item_id' => $salesObjective->item_id,
        ]);
        return redirect('/supervisor/displaySalesObjectiveReps/'.$id)->with('status','تم إضافة البيانات بشكل ناجح');
    }
    protected function getRules()
    {
        return $rules = [
                'objective' => 'required|numeric',
                'description' => 'required|string',
            ];
    }
    protected function getMessages()
    {
        return $messages = [
            'objective.required' => 'يجب عليك كتابة الهدف',
            'objective.numeric' => 'يجب ان يكون هذا الحقل عدداً',
            'description.required' => 'يجب عليك كتابة الوصف',
        ];
    }
    public function editDividedSalesObjective($id)
    {
        $salesObjective = Salesobjective::find($id);
        if(!$salesObjective)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده']);
        
        return view('supervisors.editDividedSalesObjective',compact('salesObjective',$salesObjective));
    }
    public function updateDividedSalesObjective(Request $request,$id)
    {
        $rules = ['objective' => 'required|numeric'];
        $messages = [
            'objective.required' => 'يجب عليك كتابة الهدف',
            'objective.numeric' => 'يجب ان يكون هذا الحقل عدداً',
        ];;
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $salesObjective = Salesobjective::find($id);
        $salesObjective->objective = $request->objective;
        $salesObjective->update();

        return redirect('/supervisor/displaySalesObjectiveReps/'.$salesObjective->id)->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteDividedSalesObjective($id)
    {
        $salesObjective = Salesobjective::find($id);
        if(!$salesObjective)
            redirect()->back()->with(['error' => 'هذه البيانات غير موجوده']);
        $salesObjective->delete();

        return redirect('/supervisor/displaySalesObjectiveReps/'.$salesObjective->item_id)->with('status','تم حذف البيانات بشكل ناجح');
    }
    public function divideSalesObjective($id)
    {
        $salesObjective = Salesobjective::find($id);
        if(!$salesObjective)
            redirect()->back()->with(['error' => 'هذه البيانات غير موجوده']);
        $representatives = Representative::whereDoesntHave('salesObjectives')->get();
        return view('supervisors.divideSalesObjective',compact('salesObjective',$salesObjective))
        ->with('representatives',$representatives);
    }
    public function storeDividedSalesObjectives(Request $request)
    {
        $i = -1;
        foreach($request->objective as $s)
        {
            $i++;
            Salesobjective::create([
                'objective' => $s,
                'description' => $request->description,
                'supervisor_id' => Auth::user()->supervisor->id,
                'representative_id' => $request->representative[$i],
                'item_id' => $request->item_id,
            ]);
        }
        return redirect('/supervisor/manageSalesObjectives')->with('status','تم توزيع الهدف البيعي بشكل ناجح');
    }
    public function displaySalesObjectiveReps($id)
    {
        $salesObjective = Salesobjective::find($id); 
        $salesObjectives = Salesobjective::whereHas('representative')
        ->where('item_id',$salesObjective->item_id)->get();
        if($salesObjectives->count() < 1)
        {
            $salesObjective = Salesobjective::where('supervisor_id',Auth::user()->supervisor->id)
            ->where('item_id',$id)->first();
            $salesObjectives = Salesobjective::whereHas('representative')
            ->where('item_id',$salesObjective->item_id)->get();
        }
        // $item = Item::find($id);
        return view('supervisors.displaysalesObjectiveReps',compact('salesObjectives',$salesObjectives))
        ->with('salesObjective',$salesObjective);
    }
}
