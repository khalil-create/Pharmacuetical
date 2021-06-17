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
            'item' => $request->item,
            'count' => $request->count,
            'manager_id' => Auth::user()->manager->id,
            'supervisor_id' => $request->supervisor_id,
        ]);
        return redirect('/Supervisor/manageSamples')->with('status','تم إضافة البيانات بشكل ناجح');
    }
    protected function getRules()
    {
        return $rules = [
                'item' => 'required|string|max:255',
                'count' => 'required|numeric|max:255',
            ];
    }
    protected function getMessages()
    {
        return $messages = [
            'item.required' => 'يجب عليك كتابة اسم العينة',
            'count.required' => 'يجب عليك كتابة الكمية',
            'item.string' => 'يجب ان يكون هذا الحقل بشكل نصي',
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
        return view('supervisors.editSample',compact('sample',$sample))->
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
        $sample->item = $request->item;
        $sample->count = $request->count;
        $sample->manager_id = Auth::user()->manager->id;
        $sample->supervisor_id = $request->supervisor_id;
        $sample->update();

        return redirect('/Supervisor/manageSamples')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteSample($id)
    {
        $sample = Sample::find($id);
        $sample->delete();
        return redirect('/Supervisor/manageSamples')->with('status','تم حذف البيانات بشكل ناجح');
    }
    public function divideSample($id)
    {
        // $sample = Sample::get()->where;
        // // $rep = Representative::where('supervisor_id',Auth::user()->supervisor->id);
        // return view('supervisors.divideSample',compact('sample',$sample));
    }
}
