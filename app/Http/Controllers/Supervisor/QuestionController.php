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
    public function getAllQuestions($id)
    {
        $test = Test::findOrfail($id);
        $questions = Question::where('test_id',$id)->get();
        return view('supervisors.manageQuestions',compact('questions'))->with('test',$test);
    }
    public function addQuestion($id)
    {
        $test = Test::findOrfail($id);
        return view('supervisors.addQuestion',compact('id'))->with('test',$test);
    }
    public function storeQuestion(Request $request,$id)
    {
        $test = Test::findOrfail($id);
        $answer = $request->right_answer;
        $choice1 = $request->choice1;
        $choice2 = $request->choice2;
        $choice3 = $request->choice3;
        $choice4 = $request->choice4;
        if($test->type == 1 && !($answer == $choice1 || $answer == $choice2 || $answer == $choice3 || $answer == $choice4))
            return redirect()->back()->with(['error' => 'يجب ان تكون الاجابه من احدى الاختيارات ']);
        
        if($test->type == 0)
        {
            $rules = $this->getRules2();
            $messages = $this->getMessages2();
            $validator = Validator::make($request->all(),$rules,$messages);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInputs($request->all());
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

            Question::create([
                'question' => $request->question,
                'choices' => $choice1.'++'.$choice2.'++'.$choice3.'++'.$choice4,
                'right_answer' => $answer,
                'test_id' => $test->id,
            ]);
        }
        
        
        return redirect('/supervisor/manageQuestions/'.$test->id)->with('status','تم إضافة البيانات بشكل ناجح');
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
    public function editQuestion($id)
    {
        $question = Question::find($id);
        if($question->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        return view('supervisors.editQuestion', compact('question'));
    }
    public function updateQuestion(Request $request,$id)
    {
        $question = Question::find($id);
        if($question->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $answer = $request->right_answer;
        $choice1 = $request->choice1;
        $choice2 = $request->choice2;
        $choice3 = $request->choice3;
        $choice4 = $request->choice4;
        if($question->test->type == 1 && !($answer == $choice1 || $answer == $choice2 || $answer == $choice3 || $answer == $choice4))
            return redirect()->back()->with(['error' => 'يجب ان تكون الاجابه من احدى الاختيارات ']);
        
        if($question->test->type == 0)
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
            $question->test_id = $question->test->id;
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
            $question->test_id = $question->test->id;
            $question->update();
        }
        return redirect('/supervisor/manageQuestions/'.$question->test->id)->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteQuestion($id)
    {
        $question = Question::findOrfail($id);
        if($question->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $question->delete();

        return redirect('/supervisor/manageQuestions/'.$question->test->id)->with('status','تم حذف البيانات بشكل ناجح');
    }
}
