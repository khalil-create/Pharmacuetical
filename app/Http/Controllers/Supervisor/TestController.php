<?php

namespace App\Http\Controllers\Supervisor;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Representative;
use App\Models\RepresentativeTest;
use App\Models\Test;
use App\Traits\userTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TestController extends Controller
{
    use userTrait;
    ///////////////////////////////////////////////////////////////// Start Test ////////////////////////////////////////////////////////////
    public function getAllTests(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        $tests = Test::where('supervisor_id',Auth::user()->supervisor->id)
        ->whereNull('type_id')->get();
        return view('supervisors.manageTests',compact('tests'));
    }
    public function addTest()
    {
        return view('supervisors.addTest');
    }
    public function storeTest(Request $request)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        Test::create([
            'test_name' => $request->test_name,
            // 'type' => $request->type,
            'supervisor_id' => Auth::user()->supervisor->id,
        ]);
        
        return redirect('/supervisor/manageTests')->with('status','تم إضافة البيانات بشكل ناجح');
    }
    protected function getRules()
    {
        return $rules = [
                'test_name' => 'required|string|max:255',
            ];
    }
    protected function getMessages()
    {
        return $messages = [
            'test_name.required' => 'يجب عليك كتابة اسم الاختبار',
            'test_name.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'test_name.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',
        ];
    }
    public function editTest($id)
    {
        $test = Test::find($id); 
        if($test->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        return view('supervisors.editTest', compact('test'));
    }
    public function updateTest(Request $request,$id)
    {
        $test = Test::find($id);
        if($test->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $test->test_name = $request->test_name;
        // $test->type = $request->type;
        $test->update();
        
        return redirect('/supervisor/manageTests')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteTest($id)
    {
        $test = Test::findOrfail($id);
        if($test->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $test->delete();

        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
        // return redirect('/supervisor/manageTests')->with('status','تم حذف البيانات بشكل ناجح');
    }
    public function getAllTestTypes($id)
    {
        $test = Test::findOrfail($id);
        if($test->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);

        return view('supervisors.manageTestTypes', compact('test'));
    }
    ///////////////////////////////////////////////////////////////// End Test ////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////// Start Test Representatives Results  ////////////////////////////////////////////////////////////
    public function getTestRepsResults($test_id)
    {
        $test = Test::findOrfail($test_id);
        if($test->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);

        return view('supervisors.manageTestRepsResults', compact('test'));
    }
    public function deleteTestRepResult($id)
    {
        $repResult = RepresentativeTest::findOrfail($id);
        return $repResult;
        if($repResult->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $repResult->delete();

        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
        // return redirect('/supervisor/manageTests')->with('status','تم حذف البيانات بشكل ناجح');
    }
    ///////////////////////////////////////////////////////////////// End Test Representatives Results ////////////////////////////////////////////////////////////
    
    ///////////////////////////////////////////////////////////////// Start Test Representative ////////////////////////////////////////////////////////////
    public function getAllTestReps($id)
    {
        $test = Test::findOrfail($id);
        if($test->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        // foreach($test->representatives as $rep){
        //     return $rep->repTests;
        // }
        // return $test->representatives;
        return view('supervisors.manageTestReps', compact('test'));
    }
    public function addTestReps($id)
    {
        $test = Test::findOrfail($id);
        if($test->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $reps = Representative::where('supervisor_id',Auth::user()->supervisor->id)->get();
        return view('supervisors.addTestReps', compact('test'))->with('reps',$reps);
    }
    public function storeTestReps(Request $request,$id)
    {
        $rules = [
            'repIds' => 'required',
        ];
        $messages = [
            'repIds.required' => 'يجب عليك اختيار على الاقل مندوب واحد ',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }

        $test = Test::findOrfail($id);
        if($test->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);

        $test->representatives()->attach($request->repIds);
        foreach($request->repIds as $id){
            ////////////// Notify user //////////////////////
            $rep = Representative::findOrfail($id);
            $this->notifyUser('اختبارات','لديك اختبار جديد',$rep->user->id);
        }
        return redirect('/supervisor/manageTestReps/'.$test->id)->with('status','تم إضافة البيانات بشكل ناجح');
    }
    public function deleteTestRep(Request $request)
    {
        $rep_id = $request->get('rep_id');
        $test_id = $request->get('test_id');
        $repTest = RepresentativeTest::where('representative_id',$rep_id)->where('test_id',$test_id)->first();
        $repTest->delete();

        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
    }
    public function showRepsTest(Request $request)
    {
        $rep_id = $request->get('rep_id');
        $test_id = $request->get('test_id');
        $repResult = RepresentativeTest::where('representative_id',$rep_id)->where('test_id',$test_id)->first();
        if($repResult->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        return view('supervisors.representativeResult',compact('repResult'));
    }  
    ///////////////////////////////////////////////////////////////// End Test Representative ////////////////////////////////////////////////////////////
}
