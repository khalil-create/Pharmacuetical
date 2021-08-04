<?php

namespace App\Http\Controllers\Managers\marketing;
use App\Models\Salesobjective;
use App\Models\Item;
use App\Http\Controllers\Controller;
use App\Models\Supervisor;
use App\Traits\userTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Empty_;

use function PHPUnit\Framework\isEmpty;

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
        $salesObjectives = Salesobjective::whereHas('manager')->where('supervisor_id',null)->get();
        // $supObj = Salesobjective::whereHas('supervisor')->get();
        // return $salesObjectives;
        return view('managers.marketing.manageSalesObjectives',compact('salesObjectives',$salesObjectives));
    }
    public function addSalesObjective()
    {
        $items = Item::whereDoesntHave('saleObjective')->get();
        if($items->count() < 1)
            return redirect()->back()->with(['error' => 'لقد تم اضافة هدف بيعي لجميع الاصناف']);
        return view('managers.marketing.addSalesObjective',compact('items',$items));
    }
    public function storeSalesObjective(Request $request)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        Salesobjective::create([
            'objective' => $request->objective,
            'description' => $request->description,
            'manager_id' => Auth::user()->manager->id,
            'item_id' => $request->item_id,
        ]);
        return redirect('/managerMarketing/manageSalesObjectives')->with('status','تم إضافة البيانات بشكل ناجح');
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
    public function editSalesObjective($id)
    {
        $salesObjective = Salesobjective::find($id);
        $items = Item::get();
        if(!$salesObjective)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده']);
        return view('managers.marketing.editSalesObjective',compact('salesObjective',$salesObjective))->with('items',$items);
    }
    public function updateSalesObjective(Request $request,$id)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $salesObjective = Salesobjective::find($id);
        $salesObjective->objective = $request->objective;
        $salesObjective->description = $request->description;
        $salesObjective->manager_id = Auth::user()->manager->id;
        $salesObjective->item_id = $request->item_id;
        $salesObjective->update();

        return redirect('/managerMarketing/manageSalesObjectives')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteSalesObjective($id)
    {
        $salesObjective = Salesobjective::find($id);
        if(!$salesObjective)
            redirect()->back()->with(['error' => 'هذه البيانات غير موجوده']);
        $sup = Salesobjective::where('item_id',$salesObjective->item_id)->get();
        foreach($sup as $s)
            $s->delete();
        // $salesObjective->delete();

        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
        // return redirect('/managerMarketing/manageSalesObjectives')->with('status','تم حذف البيانات بشكل ناجح');
    }
    public function distributeSalesObjective($id)
    {
        $salesObjective = Salesobjective::find($id);
        $sales = Salesobjective::where('item_id',$salesObjective->item_id)->whereNotNull(['supervisor_id','manager_id'])->get();
        $sales = $sales->toArray();
        // return $sales;
        // $salesObjectiveDistributed = Salesobjective::whereDosntHave('supervisor')
        // ->where('item_id',$salesObjective->item_id)->get();
        $supervisors = Supervisor::get();
        if(!$salesObjective)
            redirect()->back()->with(['error' => 'هذه البيانات غير موجوده']);
        // $supervisors = Supervisor::get();
        return view('managers.marketing.distributeSalesObjective',compact('salesObjective',$salesObjective))
        ->with('supervisors',$supervisors)->with('sales',$sales);
    }
    public function storeDistributedSalesObjForSup(Request $request)
    {
        $sales = Salesobjective::where('item_id',$request->item_id)->whereNotNull(['manager_id','supervisor_id'])->get();

        $sales = $sales->toArray(); //convert to array
        $total_obj = sizeof($request->objective);
        $i = -1;
        foreach($request->objective as $obj)
        {   
            $i++;
            //if edit on objectives, update objective to new value
            if($sales && sizeof($sales) != $i && $sales[$i]["supervisor_id"] == $request->supervisor[$i] && $sales[$i]["objective"] != $obj){
                if($obj == ''){
                    $s = Salesobjective::findOrfail($sales[$i]["id"]);
                    $s->delete();
                }
                else
                {
                    $s = Salesobjective::findOrfail($sales[$i]["id"]);
                    $s->objective = $obj;
                    $s->update();
                }
            }
            else if($obj != '')
            {
                Salesobjective::create([
                    'objective' => $obj,
                    'description' => $request->description,
                    'manager_id' => Auth::user()->manager->id,
                    'supervisor_id' => $request->supervisor[$i],
                    'item_id' => $request->item_id,
                ]);
                //////////////// Notify user //////////////////////////
                $sup = Supervisor::findOrfail($request->supervisor[$i]);
                $this->notifyUser('اهداف','لديك هدف بيعي جديد',$sup->user->id);
            }
        }
        return redirect('/managerMarketing/manageSalesObjectives')->with('status','تم توزيع الهدف البيعي بشكل ناجح');
    }
}
