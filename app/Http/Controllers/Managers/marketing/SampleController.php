<?php

namespace App\Http\Controllers\Managers\marketing;
use App\Models\Sample;
use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\Supervisor;
use App\Models\Item;
use App\Traits\userTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SampleController extends Controller
{
    use userTrait;
    public function getAllSamples(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        $samples = Sample::whereNotNull(['manager_id','supervisor_id'])->get();
        $supervisors = Supervisor::with('user')->get();
        return view('managers.marketing.manageSamples',compact('samples',$samples))->with('supervisors',$supervisors);
    }
    public function getSupervisorSamples($id)
    {
        $supervisor = Supervisor::find($id);
        if($supervisor->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده']);
        
        $samples = Sample::whereNotNull('supervisor_id')->whereNull('representative_id')->get();
        // return $samples;
        // $items = Item::get();
        // $supervisors = Supervisor::whereHas('user')->get();
        return view('managers.marketing.supervisorSamples',compact('supervisor'))->with('samples',$samples);
    }
    public function deleteSupervisorSamples($id)
    {
        $supervisor = Supervisor::find($id);
        if($supervisor->samples()->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده']);
        $supervisor->samples()->delete();
        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
        // return redirect('/managerMarketing/manageSamples')->with('status','تم حذف البيانات بشكل ناجح');
    }
    public function addSample($id) // because the id is optional
    {
        if($id == 0){ // if id is not found
            $items = Item::all();
            if($items->count() < 1)
                return redirect()->back()->with('error','لايمكنك اضافة عينة ولم يتم اضافة على الأقل صنف واحد لهذا المشرف');
            $supervisors = Supervisor::all();
            return view('managers.marketing.addSample',compact('items'))->with('supervisors',$supervisors);
        }
        else{ // id is found, this id is supervisor id
            $supervisor = Supervisor::findOrfail($id);
            $items = $this->getSupervisorItems($supervisor->user);
            if($items->count() < 1)
                return redirect()->back()->with('error','لايمكنك اضافة عينة ولم يتم اضافة على الأقل صنف واحد لهذا المشرف');
            return view('managers.marketing.addSample',compact('supervisor'))->with('items',$items);
        }
    }
    public function storeSample(Request $request,$id)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        if($id == 0)
            $supervisor_id = $request->supervisor_id;
        else
            $supervisor_id = $id;

        $item_id = $request->item_id;
        $sample = Sample::where('supervisor_id',$supervisor_id)->where('item_id',$item_id)->first();
        if($sample){
            $sample->count += $request->count;
            $sample->update();
        }
        else{
            Sample::create([
                'item_id' => $request->item_id,
                'count' => $request->count,
                'manager_id' => Auth::user()->manager->id,
                'supervisor_id' => $supervisor_id,
            ]);
        }
        //////////////// Notify user //////////////////////////
        if($id != 0){
            $sup = Supervisor::findOrfail($id);
            $this->notifyUser('عينات','لديك عينات جديده',$sup->user->id);
            return redirect('/managerMarketing/supervisorSamples/'.$id)->with('status','تم إضافة البيانات بشكل ناجح');
        }
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
        if($sample->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده']);
        $supervisor = Supervisor::findOrfail($sample->supervisor_id);
        $items = $this->getSupervisorItems($supervisor->user);
        if($items->count() < 1)
            return redirect()->back()->with('error','لايمكنك اضافة عينة ولم يتم اضافة على الأقل صنف واحد لهذا المشرف');
        return view('managers.marketing.editSupervisorSample',compact('supervisor'))
        ->with('sample',$sample)->with('items',$items);
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
        $sample->supervisor_id = $sample->supervisor_id;
        $sample->update();

        return redirect('/managerMarketing/supervisorSamples/'.$sample->supervisor_id)->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteSupervisorSample($id)
    {
        $sample = Sample::find($id);
        if($sample->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده']);
        $sample->delete();
        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
    }
}
