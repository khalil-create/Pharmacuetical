<?php

namespace App\Http\Controllers\Managers\marketing;
use App\Models\Sample;
use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\Supervisor;
use App\Models\Item;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SampleController extends Controller
{
    public function getAllSamples()
    {
        $samples = Sample::whereHas('manager')->get();
        return view('managers.marketing.manageSamples',compact('samples',$samples));
    }
    public function addSample()
    {
        $items = Item::get();
        if($items->count() < 1)
            return redirect('/managerMarketing/manageSamples')->with('error','لايمكنك اضافة عينة ولم يتم اضافة على الأقل صنف واحد');
        $supervisors = Supervisor::whereHas('user')->get();
        return view('managers.marketing.addSample',compact('supervisors',$supervisors))->with('items',$items);
    }
    public function storeSample(Request $request)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        // return $request->manager_id;
        Sample::create([
            'item_id' => $request->item_id,
            'count' => $request->count,
            'manager_id' => Auth::user()->manager->id,
            'supervisor_id' => $request->supervisor_id,
        ]);
        return redirect('/managerMarketing/manageSamples')->with('status','تم إضافة البيانات بشكل ناجح');
    }
    protected function getRules()
    {
        return $rules = [
                'item_id' => 'required',
                'count' => 'required|numeric|max:255',
            ];
    }
    protected function getMessages()
    {
        return $messages = [
            'item_id.required' => 'يجب عليك كتابة اسم العينة',
            'count.required' => 'يجب عليك كتابة الكمية',
            'count.numeric' => 'يجب ان يكون هذا الحقل عدداً',
        ];
    }
    public function editSample($id)
    {
        $sample = Sample::find($id);
        if(!$sample)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده']);
        
        $items = Item::get();
        $supervisors = Supervisor::whereHas('user')->get();
        return view('managers.marketing.editSample',compact('sample',$sample))->
        with('items',$items)->with('supervisors',$supervisors);
    }
    public function updateSample(Request $request,$id)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $sample = Sample::find($id);
        $sample->item_id = $request->item_id;
        $sample->count = $request->count;
        $sample->manager_id = Auth::user()->manager->id;
        $sample->supervisor_id = $request->supervisor_id;
        $sample->update();

        return redirect('/managerMarketing/manageSamples')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteSample($id)
    {
        $sample = Sample::find($id);
        $sample->delete();
        return redirect('/managerMarketing/manageSamples')->with('status','تم حذف البيانات بشكل ناجح');
    }
}
