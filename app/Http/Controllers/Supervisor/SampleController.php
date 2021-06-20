<?php

namespace App\Http\Controllers\Supervisor;
use App\Models\Sample;
use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\Supervisor;
use App\Models\Representative;
use App\Models\Item;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SampleController extends Controller
{
    public function getAllSamples()
    {
        $samples = Sample::whereHas('supervisor')->where('manager_id','!=',null)->with(['supervisor' => function($q){
            $q->where('id',Auth::user()->supervisor->id);
        }])->get();
        return view('supervisors.manageSamples',compact('samples',$samples));
    }
    public function addSample()
    {
        $items = Item::get();
        if($items->count() < 1)
            return redirect('/supervisors/manageSamples')->with('error','لايمكنك اضافة عينة ولم يتم اضافة على الأقل صنف واحد');
        $rep = Representative::where('supervisor_id',Auth::user()->supervisor->id)->get();
        return view('supervisors.addSample',compact('rep',$rep))->with('items',$items);
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
            'representative_id' => $request->rep_id,
            'supervisor_id' => Auth::user()->supervisor->id,
        ]);
        return redirect('/supervisor/manageSamples')->with('status','تم إضافة البيانات بشكل ناجح');
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
    public function editDividedSample($id)
    {
        $sample = Sample::find($id);
        if(!$sample)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده']);
        
        return view('supervisors.editDividedSample',compact('sample',$sample));
    }
    public function updateDividedSample(Request $request,$id)
    {
        $rules = ['count' => 'required|numeric'];
        $messages = [
            'count.required' => 'يجب عليك كتابة الكمية',
            'count.numeric' => 'يجب ان يكون هذا الحقل عدداً',
        ];;
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $sample = Sample::find($id);
        $sample->count = $request->count;
        $sample->update();

        return redirect('/supervisor/displaySampleReps/'.$sample->id)->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteSample($id)
    {
        $sample = Sample::find($id);
        $sample->delete();
        return redirect('/supervisor/manageSamples')->with('status','تم حذف البيانات بشكل ناجح');
    }
    public function divideSample($id)
    {
        $sample = Sample::find($id);
        $rep = Representative::where('supervisor_id',Auth::user()->supervisor->id)->get();
        // return $rep;
        return view('supervisors.divideSample',compact('sample',$sample))->with('rep',$rep);
    }
    public function storeDividedSample(Request $request)
    {
        $i = -1;
        foreach($request->count as $s)
        {
            $i++;
            Sample::create([
                'item_id' => $request->item_id,
                'count' => $request->count[$i],
                'representative_id' => $request->representative[$i],
                'supervisor_id' => Auth::user()->supervisor->id,
            ]);
        }
        return redirect('/supervisor/manageSamples')->with('status','تم توزيع العينة بشكل ناجح');
    }
    public function displaySampleReps($id)
    {
        $sample = Sample::find($id); 
        $samples = Sample::whereHas('supervisor')->where('manager_id',null)
        ->where('item_id',$sample->item_id)->get();
        // $item = Item::find($id);
        return view('supervisors.displaySampleReps',compact('samples',$samples))->with('sample',$sample);
    }
}
