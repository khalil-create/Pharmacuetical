<?php

namespace App\Http\Controllers\Supervisor;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function getAllTests()
    {
        $tests = Test::where('supervisor_id',Auth::user()->supervisor->id)->get();
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
            'type' => $request->type,
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
        $test->type = $request->type;
        $test->update();
        
        return redirect('/supervisor/manageTests')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteTest($id)
    {
        $test = Test::findOrfail($id);
        if($test->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $test->delete();

        return redirect('/supervisor/manageTests')->with('status','تم حذف البيانات بشكل ناجح');
    }
}
