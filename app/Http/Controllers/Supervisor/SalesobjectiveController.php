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
use App\Notifications\UserNotification;
use App\Traits\userTrait;
use Illuminate\Notifications\Notification;
class SalesobjectiveController extends Controller
{
    use userTrait;
    public function home()
    {
        return view('managers.marketing.home');
    }
    public function getAllSalesObjectives(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        $salesObjectives = Salesobjective::whereHas('supervisor')
        ->where('supervisor_id',Auth::user()->supervisor->id)->whereNotNull(['manager_id','supervisor_id'])->get();
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

        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
        // return redirect('/supervisor/displaySalesObjectiveReps/'.$salesObjective->item_id)->with('status','تم حذف البيانات بشكل ناجح');
    }
    public function divideSalesObjective($id)
    {
        $salesObjective = Salesobjective::find($id);
        $sales = Salesobjective::where('item_id',$salesObjective->item_id)->whereNotNull(['supervisor_id','representative_id'])->get();
        // $sales = $sales->toArray();
        $sales = $sales->sortBy('representative_id');
        // return $sales;
        if(!$salesObjective)
            redirect()->back()->with(['error' => 'هذه البيانات غير موجوده']);
        // $representatives = Representative::whereDoesntHave('salesObjectives')->get();
        $representatives = Representative::where('supervisor_id',Auth::user()->supervisor->id)->with('salesObjectives')->get();
        return view('supervisors.divideSalesObjective',compact('salesObjective',$salesObjective))
        ->with('representatives',$representatives)->with('sales',$sales);
    }
    public function storeDividedSalesObjectives(Request $request)
    {
        // retrieve objectives if exist
        $sales = Salesobjective::where('item_id',$request->item_id)->whereNotNull(['representative_id','supervisor_id'])->get();
        $total_obj = sizeof($request->objective);
        $i = -1;
        foreach($request->objective as $obj)
        {   
            $i++;
            $exist = false;
            foreach($sales as $sale){
                //if edit on samples, update sample to new value
                if($sale->representative_id == $request->representative[$i]){
                    if($sale->objective != $obj){
                        if($obj == ''){
                            // return "delete".$i;
                            $s = Salesobjective::findOrfail($sale->id);
                            $s->delete();
                        }
                        else{
                            // return "update".$i;
                            $s = Salesobjective::findOrfail($sale->id);
                            $s->objective = $obj;
                            $s->update();
                        }
                    }
                    $exist = true;
                    break;
                }
            }
            if(!$exist && $obj != ''){
                Salesobjective::create([
                    'objective' => $obj,
                    'description' => $request->description,
                    'supervisor_id' => Auth::user()->supervisor->id,
                    'representative_id' => $request->representative[$i],
                    'item_id' => $request->item_id,
                ]);
                //////////////// Notify user //////////////////////////
                $rep = Representative::findOrfail($request->representative[$i]);
                $this->notifyUser('اهداف','يوجد لديك هدف بيعي',$rep->user->id);
            }
        }
        return redirect('/supervisor/manageSalesObjectives')->with('status','تم توزيع الهدف البيعي بشكل ناجح');
    }
    public function displaySalesObjectiveReps($id)
    {
        $salesObjective = Salesobjective::find($id); 
        // return $salesObjective;
        $salesObjectives = Salesobjective::whereHas('representative')
        ->where('item_id',$salesObjective->item_id)->get();
        // return $salesObjective;
        if($salesObjectives->count() > 0)
        {
            $salesObjective = Salesobjective::where('supervisor_id',Auth::user()->supervisor->id)
            ->where('item_id',$salesObjective->item_id)->first();
            $salesObjectives = Salesobjective::whereHas('representative')
            ->where('item_id',$salesObjective->item_id)->get();
        }
        // $item = Item::find($id);
        return view('supervisors.displaysalesObjectiveReps',compact('salesObjectives',$salesObjectives))
        ->with('salesObjective',$salesObjective);
    }
}
