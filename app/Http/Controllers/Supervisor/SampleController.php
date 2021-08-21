<?php

namespace App\Http\Controllers\Supervisor;
use App\Models\Sample;
use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\Supervisor;
use App\Models\Representative;
use App\Models\Item;
use App\Models\User;
use App\Traits\userTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Samples;

class SampleController extends Controller
{
    use userTrait;
    public function getAllSamples(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        $samples = Sample::where('supervisor_id',Auth::user()->supervisor->id)->whereNull('representative_id')->get();
        return view('supervisors.manageSamples',compact('samples',$samples));
    }
    public function addSample()
    {
        $items = $this->getSupervisorItems(Auth::user());
        if($items->count() < 1)
            return redirect('/supervisors/manageSamples')->with('error','لايمكنك اضافة عينة ولم يتم اضافة على الأقل صنف واحد');
        return view('supervisors.addSample',compact('items'));
    }
    public function storeSample(Request $request)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $supervisor_id = Auth::user()->supervisor->id;
        $item_id = $request->item_id;
        $sample = Sample::where('supervisor_id',$supervisor_id)->where('item_id',$item_id)->first();
        if($sample){
            $sample->count += $request->count;
            $sample->update();
        }
        else{
            $sample = Sample::create([
                'item_id' => $item_id,
                'count' => $request->count,
                // 'manager_id' => $this->getManagerMarketingId(), 
                'supervisor_id' => $supervisor_id,
            ]);
        }
        ////////////////////// Notify user //////////////////////////////////
        $name = explode(' ',Auth::user()->user_name_third);
        $user_managerMarketing_id = User::where('user_type','مدير تسويق')->first()->id;
        $notify_msg = 'قام المشرف '.  $name[0].' باضافة عينات له';
        $this->notifyUser('عينات',$notify_msg,$user_managerMarketing_id);
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
        ];
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
        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
        // return redirect('/supervisor/manageSamples')->with('status','تم حذف البيانات بشكل ناجح');
    }
    public function divideSample($id)
    {
        $sample = Sample::find($id);
        if(!$sample)
            redirect()->back()->with(['error' => 'هذه البيانات غير موجوده']);
        $samples = Sample::where('item_id',$sample->item_id)->whereNotNull(['representative_id','supervisor_id'])->get();
        $samples = $samples->sortBy('representative_id');
        // return $samples;
        $rep = Representative::where('supervisor_id',Auth::user()->supervisor->id)->get();
        return view('supervisors.divideSample',compact('sample'))->with('rep',$rep)->with('samples',$samples);
    }
    public function storeDividedSample(Request $request)
    {
        // $i = -1;
        // foreach($request->count as $s)
        // {
        //     $i++;
        //     Sample::create([
                // 'item_id' => $request->item_id,
                // 'count' => $request->count[$i],
                // 'representative_id' => $request->representative[$i],
                // 'supervisor_id' => Auth::user()->supervisor->id,
        //     ]);
        // }
////////////////////////////
        // return $request->representative;
        // retrieve samples if exist
        $samples = Sample::where('item_id',$request->item_id)->whereNotNull(['representative_id','supervisor_id'])->get();
        // $samples = $samples->toArray(); //convert to array
        $total_samples = sizeof($request->count);
        $i = -1;
        // return $samples; 
        foreach($request->count as $count)
        {   
            $i++;
            // //if edit on samples, update sample to new value
            // if($samples && sizeof($samples) != $i && $samples[$i]["representative_id"] == $request->representative[$i] && $samples[$i]["count"] != $count){
            //     if($count == ''){
            //         return "delete";
            //         $s = Sample::findOrfail($samples[$i]["id"]);
            //         $s->delete();
            //     }
            //     else
            //     {
            //         return "update";
            //         $s = Sample::findOrfail($samples[$i]["id"]);
            //         $s->count = $count;
            //         $s->update();
            //     }
            // }
            // else if($count != '' && $samples[$i]["count"] != $count){
            //     return "create";
            //     Sample::create([
            //         'item_id' => $request->item_id,
            //         'count' => $request->count[$i],
            //         'representative_id' => $request->representative[$i],
            //         'supervisor_id' => Auth::user()->supervisor->id,
            //     ]);
            // }
            $exist = false;
            foreach($samples as $sample){
                //if edit on samples, update sample to new value
                if($sample->representative_id == $request->representative[$i]){
                    if($sample->count != $count){
                        if($count == ''){
                            // return "delete".$i;
                            $s = Sample::findOrfail($sample->id);
                            $s->delete();
                        }
                        else{
                            // return "update".$i;
                            $s = Sample::findOrfail($sample->id);
                            $s->count = $count;
                            $s->update();
                        }
                    }
                    $exist = true;
                    break;
                }
            }
            if(!$exist && $count != ''){
                // return "create".$i;
                Sample::create([
                    'item_id' => $request->item_id,
                    'count' => $count,
                    'representative_id' => $request->representative[$i],
                    'supervisor_id' => Auth::user()->supervisor->id,
                ]);
                //////////////// Notify user //////////////////////////
                $rep = Representative::findOrfail($request->representative[$i]);
                $this->notifyUser('عينات','لديك عينات جديدة',$rep->user->id);
            }
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
