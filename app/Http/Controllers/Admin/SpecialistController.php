<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specialist;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SpecialistController extends Controller
{
    public function getAllSpecialists()
    {
        $specialists = Specialist::all();
        return view('admin.manageSpecialistsDoctors',compact('specialists'));
    }
    public function addSpecialist()
    {
        return view('admin.addSpecialist');
    }
    public function storeSpecialist(Request $request)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        Specialist::create([
            'name' => $request->name,
        ]);        
        return redirect('/admin/manageSpecialistsDoctors')->with('status','تم إضافة البيانات بشكل ناجح');
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected function getRules()
    {
        return $rules = [
                'name' => 'required|string|max:255|unique:specialists',
            ];
    }
    protected function getMessages()
    {
        return $messages = [
            'name.required' => 'يجب عليك كتابة هذا الحقل',
            'name.string' => 'يجب ان يكون هذا الحقل نص',
            'name.max' => 'يجب ان لا يتجاوز هذا الحقل فوق 255 حرف',
            'name.unique' => 'هذا التخصص موجود بالفعل',
        ];
    }
    public function editSpecialist($id)
    {
        $specialist = Specialist::find($id); 
        if($specialist->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        return view('admin.editSpecialist',compact('specialist'));
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function UpdateSpecialist(Request $request,$id)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $specialist = Specialist::find($id);
        if($specialist->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);

        $specialist->name = $request->name;
        $specialist->update();

        return redirect('/admin/manageSpecialistsDoctors')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteSpecialist($id)
    {
        $specialist = Specialist::findOrfail($id);
        if(!$specialist)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $specialist->delete();

        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
    }
}
