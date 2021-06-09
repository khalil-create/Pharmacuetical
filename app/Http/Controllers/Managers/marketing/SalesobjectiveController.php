<?php

namespace App\Http\Controllers\Managers\marketing;
use App\Models\Salesobjective;
use App\Models\Item;
use App\Http\Controllers\Controller;
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
        $salesObjectives = Salesobjective::whereHas('manager')->get();
        $supObj = Salesobjective::whereHas('supervisor')->get();
        // return $salesObjectives;
        return view('managers.marketing.manageSalesObjectives',compact('salesObjectives',$salesObjectives))
        ->with('supObj',$supObj);
    }
    public function addSalesObjective()
    {
        $items = Item::get();
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
        return redirect('/manageSalesObjectives')->with('status','تم إضافة البيانات بشكل ناجح');
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
            redirect()->back()->with(['error' => 'هذه البيانات غير موجوده']);
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

        return redirect('/manageSalesObjectives')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteSalesObjective($id)
    {
        $salesObjective = Salesobjective::find($id);
        if(!$salesObjective)
            redirect()->back()->with(['error' => 'هذه البيانات غير موجوده']);
        $salesObjective->delete();

        return redirect('/manageSalesObjectives')->with('status','تم حذف البيانات بشكل ناجح');
    }
    public function distributeSalesObjective($id)
    {
        $salesObjective = Salesobjective::find($id);
        if(!$salesObjective)
            redirect()->back()->with(['error' => 'هذه البيانات غير موجوده']);
        $supervisors = Supervisor::get();
        return view('managers.marketing.distributeSalesObjective',compact('salesObjective',$salesObjective))
        ->with('supervisors',$supervisors);
    }
    public function storeDistributedSalesObjForSup(Request $request)
    {
        $i = -1;
        foreach($request->objective as $s)
        {
            $i++;
            Salesobjective::create([
                'objective' => $s,
                'description' => $request->description,
                // 'manager_id' => Auth::user()->manager->id,
                'supervisor_id' => $request->supervisor[$i],
                'item_id' => $request->item_id,
            ]);
        }
        return redirect('/manageSalesObjectives')->with('status','تم توزيع الهدف البيعي بشكل ناجح');
    }
}
