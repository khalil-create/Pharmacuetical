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
        // $supervisors = $supervisors->toArray();
        // return $supervisors;
        return view('managers.marketing.manageSamples',compact('samples',$samples))->with('supervisors',$supervisors);
    }
    public function getSupervisorSamples($id)
    {
        $supervisor = Supervisor::find($id);
        if(!$supervisor)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده']);
        
        $samples = Sample::whereNotNull(['manager_id','supervisor_id'])->get();
        // return $samples;
        // $items = Item::get();
        // $supervisors = Supervisor::whereHas('user')->get();
        return view('managers.marketing.supervisorSamples',compact('supervisor'))->with('samples',$samples);
    }
    public function deleteSupervisorSamples($id)
    {
        $supervisor = Supervisor::find($id);
        $supervisor->samples()->delete();
        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
        // return redirect('/managerMarketing/manageSamples')->with('status','تم حذف البيانات بشكل ناجح');
    }
    public function addSample($id)
    {
        $supervisor = Supervisor::with('company')->find($id);
        // return $supervisor->company;
        if($supervisor->count() < 1 || $supervisor->company->count() < 1)
            return redirect()->back()->with('error','لايمكنك اضافة عينة ولم يتم اضافة على الأقل صنف واحد لهذا المشرف');
        // $supervisors = Supervisor::whereHas('user')->get();
        return view('managers.marketing.addSupervisorSample',compact('supervisor'));
    }
    public function storeSample(Request $request,$id)
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
            'supervisor_id' => $id,
        ]);
        //////////////// Notify user //////////////////////////
        $sup = Supervisor::findOrfail($id);
        $this->notifyUser('عينات','لديك عينات جديده',$sup->user->id);
        return redirect('/managerMarketing/supervisorSamples/'.$id)->with('status','تم إضافة البيانات بشكل ناجح');
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
        $supervisor = Supervisor::with('company')->find($sample->supervisor_id);
        if($supervisor->count() < 1 || $supervisor->company->count() < 1)
            return redirect()->back()->with('error','لايمكنك اضافة عينة ولم يتم اضافة على الأقل صنف واحد لهذا المشرف');
        return view('managers.marketing.editSupervisorSample',compact('supervisor'))->with('sample',$sample);
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
        $sup_id = $sample->supervisor_id;
        $sample->delete();
        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
        // return redirect('/managerMarketing/supervisorSamples/'.$sup_id)->with('status','تم حذف البيانات بشكل ناجح');
    }
}
