<?php

namespace App\Http\Controllers\Supervisor;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function getAllQuestions(Request $request)
    {
        $id = $request->get('id');
        $type = $request->get('type');
        $test1 = Test::findOrfail($id);
        $test11 = $test1->type()->get();
        $arr = $test11->all();
        $empty = collect();
        $questions = $empty;
        if($arr != null){
            $test2 = Test::where('type_id',$arr[0]->type_id)->
            where('type',$type)->with('type')->get();
            $arr2 = $test2->all();
            if($arr2 != null)
                $questions = Question::where('test_id',$arr2[0]->id)->get();
        }
        return view('supervisors.manageQuestions',compact('questions'))
        ->with('test',$test1)->with('type',$type);
    }
    public function addQuestion(Request $request)
    {
        $id = $request->get('id');
        $type = $request->get('type');
        $test = Test::findOrfail($id);
        return view('supervisors.addQuestion',compact('id'))
        ->with('test',$test)->with('type',$type);
    }
    public function storeQuestion(Request $request,$id)
    {
        $type = $request->type;
        $testt = Test::findOrfail($id);
        // return $testt->id;
        $answer = $request->right_answer;
        $choice1 = $request->choice1;
        $choice2 = $request->choice2;
        $choice3 = $request->choice3;
        $choice4 = $request->choice4;
        if($type == 1 && !($answer == $choice1 || $answer == $choice2 || $answer == $choice3 || $answer == $choice4))
            return redirect()->back()->with(['error' => 'يجب ان تكون الاجابه من احدى الاختيارات ']);
        
        $tests = Test::where('supervisor_id',Auth::user()->supervisor->id)
        ->where('type_id',$id)->where('type',$type)->get();
        if($type == 0)
        {
            $rules = $this->getRules2();
            $messages = $this->getMessages2();
            $validator = Validator::make($request->all(),$rules,$messages);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInputs($request->all());
            }   
            if($tests->count() == 0){ 
                $test = Test::create([
                    'test_name' => $testt->test_name,
                    'type' => $type,
                    'type_id' => $testt->id,
                    'supervisor_id' => Auth::user()->supervisor->id,
                ]);
            }
            else{
                $test = $tests->first();
            }
            Question::create([
                'question' => $request->question,
                'right_answer' => $answer,
                'choices' => 'صح++خطأ',
                'test_id' => $test->id,
            ]);
        }
        else
        {
            $rules = $this->getRules();
            $messages = $this->getMessages();
            $validator = Validator::make($request->all(),$rules,$messages);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInputs($request->all());
            }
            if($tests->count() == 0){ 
                $test = Test::create([
                    'test_name' => $testt->test_name,
                    'type' => $type,
                    'type_id' => $testt->id,
                    'supervisor_id' => Auth::user()->supervisor->id,
                ]);
            }
            else{
                $test = $tests->first();
            }
            Question::create([
                'question' => $request->question,
                'choices' => $choice1.'++'.$choice2.'++'.$choice3.'++'.$choice4,
                'right_answer' => $answer,
                'test_id' => $test->id,
            ]);
        }
        
        return redirect(route('manageQuestions',['id' => $testt->id,'type' => $type]))->with('status','تم إضافة البيانات بشكل ناجح');
    }
    protected function getRules()
    {
        return $rules = [
                'question' => 'required|string|max:255',
                'choice1' => 'required|string|max:255',
                'choice2' => 'required|string|max:255',
                'choice3' => 'required|string|max:255',
                'choice4' => 'required|string|max:255',
                'right_answer' => 'required|string|max:255',
            ];
    }
    protected function getRules2()
    {
        return [
                'question' => 'required|string|max:255',
                'right_answer' => 'required|string|max:255',
            ];
    }
    protected function getMessages()
    {
        return $messages = [
            'question.required' => 'يجب عليك كتابة السؤال',
            'question.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'question.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',

            'choice1.required' => 'يجب عليك كتابة هذا الاختيار',
            'choice1.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'choice1.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',

            'choice2.required' => 'يجب عليك كتابة هذا الاختيار',
            'choice2.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'choice2.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',

            'choice3.required' => 'يجب عليك كتابة هذا الاختيار',
            'choice3.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'choice3.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',

            'choice4.required' => 'يجب عليك كتابة هذا الاختيار',
            'choice4.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'choice4.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',
            
            'right_answer.required' => 'يجب عليك كتابة الإجابة',
            'right_answer.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'right_answer.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',
        ];
    } 
    protected function getMessages2()
    {
        return [
            'question.required' => 'يجب عليك كتابة السؤال',
            'question.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'question.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',

            'right_answer.required' => 'يجب عليك كتابة الإجابة',
            'right_answer.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'right_answer.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',
        ];
    }
    public function editQuestion(Request $request)
    {
        $id = $request->get('id');
        $type = $request->get('type');
        $test_id = $request->get('test_id');
        $question = Question::find($id);
        if($question->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        return view('supervisors.editQuestion', compact('question'))
        ->with('test_id',$test_id)->with('type',$type);
    }
    public function updateQuestion(Request $request,$id)
    {
        $type = $request->type;
        $test_id = $request->test_id;
        $question = Question::find($id);
        if($question->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $answer = $request->right_answer;
        $choice1 = $request->choice1;
        $choice2 = $request->choice2;
        $choice3 = $request->choice3;
        $choice4 = $request->choice4;
        if($type == 1 && !($answer == $choice1 || $answer == $choice2 || $answer == $choice3 || $answer == $choice4))
            return redirect()->back()->with(['error' => 'يجب ان تكون الاجابه من احدى الاختيارات ']);
        
        if($type == 0)
        {
            $rules = $this->getRules2();
            $messages = $this->getMessages2();
            $validator = Validator::make($request->all(),$rules,$messages);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInputs($request->all());
            }  
            $question->question = $request->question;
            $question->choices = 'صح++خطأ';
            $question->right_answer = $answer;
            // $question->test_id = $question->test->id;
            $question->update();
        }
        else{
            $rules = $this->getRules();
            $messages = $this->getMessages();
            $validator = Validator::make($request->all(),$rules,$messages);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInputs($request->all());
            }
            $question->question = $request->question;
            $question->choices = $choice1.'++'.$choice2.'++'.$choice3.'++'.$choice4;
            $question->right_answer = $answer;
            // $question->test_id = $question->test->id;
            $question->update();
        }
        return redirect(route('manageQuestions',['id' => $test_id,'type' => $type]))->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteQuestion(Request $request)
    {
        $id = $request->id;
        $type = $request->type;
        $test_id = $request->test_id;
        $question = Question::findOrfail($id);
        if($question->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $question->delete();

        return redirect(route('manageQuestions',['id' => $test_id,'type' => $type]))->with('status','تم حذف البيانات بشكل ناجح');
    }
}
