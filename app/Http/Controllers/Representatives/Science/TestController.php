<?php

namespace App\Http\Controllers\Representatives\Science;
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
    public function getAllTests(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        $rep = Representative::findOrfail(Auth::user()->representatives->id);
        $tests = $rep->tests->whereNull('type_id');
        // $tests = Test::where('supervisor_id',Auth::user()->representative->supervisor_id)->get();
        return view('representatives.repScience.manageTests',compact('tests'));
    }
    public function getRepTests($id)
    {
        $rep = Representative::findOrfail(Auth::user()->representatives->id);
        $test = $rep->tests()->whereNull('result')->where('test_id',$id)->get();
        $test1 = Test::findOrfail($id);
        
        /* 
            /////////////////////////////// this used when we want to one test for every rep at one test////////////////////////
        
                if($test->count() < 1)
                    return redirect()->back()->with(['error' => 'لقد تم اختبار هذا البرنامج']);

            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////  
        */
        $repTest = RepresentativeTest::where('test_id',$id)->where('representative_id',Auth::user()->representatives->id)->first();
        $results_arr = explode("+",$repTest->result);
        if(sizeof($results_arr) >= 5)
            return redirect()->back()->with(['error' => 'لقد وصلت للحد الأقصى لعدد مرات المحاولات (5)']);
        $tests = $test1->type()->with('questions')->get();
        return view('representatives.repScience.repTest',compact('tests'))
        ->with('test1',$test1);
    }
    public function storeRepTest(Request $request,$id)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        
        $grade = 0;
        $question = collect();
        // $isRight = collect();
        $your_answered = collect();
        $right_answer = $request->right_answer;
        $q = $request->questions;
        $q_id = $request->questionid;
        for($a = 0 ; $a < sizeof($q_id);$a++)
        {
            $qID = $q_id[$a];
            if($request->type[$a] == 1){
                $ans = $request->answered_choice[$qID];
                $your_answered->push($ans);
                $question->push($q[$qID]);
                if($ans == $right_answer[$a]){
                    // $isRight->push('اجابة صحيحة');
                    $grade++;
                }
            }
            else{
                $ans = $request->answered_TorF[$qID];
                $your_answered->push($ans);
                $question->push($q[$qID]);
                if($ans == $right_answer[$a]){
                    $grade++;
                    // $isRight->push('اجابة صحيحة');
                }
                // else{
                //     $question->push($q[$qID]);
                //     $isRight->push('اجابة خاطئة');
                // }
            }
        }
        $current_result = $grade*100/$a;
        $repTest = RepresentativeTest::where('test_id',$id)
        ->where('representative_id',Auth::user()->representatives->id)->first();
        $prev_result = $repTest->result; //نتيجة الاختبار السابق اذا كان قد اختبر هذا البرنامج من قبل
        if($prev_result)    // only first test this condition will be false and other tests after first(2,3,4,5,6.....n) will be true
            $repTest->result = $current_result.'+'.$prev_result;
        else    //only first time is true and other is will be true
            $repTest->result = $current_result.'+';
        $repTest->update();

        // $isRight_arr = $isRight->toArray();
        // $i = 0;
        // foreach($question as $q){
        //         echo '<p>'.$q.'  '.$isRight_arr[$i].'</p>';
        //         $i++;
        // }
        // return '%درجة الاختبار: '.($grade*100/$a);
        // return $right_answer;
        return view('representatives.repScience.results',compact('grade'))->with('question',$question)
        ->with('your_answered',$your_answered)->with('right_answer',$right_answer);
    }
    protected function getRules()
    {
        return $rules = [
                'answered_choice' => 'required',
                'answered_TorF' => 'required',
            ];
    }
    protected function getMessages()
    {
        return $messages = [
            'answered_choice.required' => 'لديك سؤال لم تقم بحله',
            'answered_TorF.required' => 'لديك سؤال لم تقم بحله',
        ];
    }
    public function showTestResult($test_id)
    {
        $test = Test::findOrfail($test_id);
        $rep_id = Auth::user()->representatives->id;
        $repResult = $test->testResults->where('representative_id',$rep_id)->whereNotNull('result')->first();
        // $repResult = RepresentativeTest::where('representative_id',$rep_id)->where('test_id',$test_id)->whereNotNull('result')->first();
        if($repResult->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        return view('representatives.repScience.testResult',compact('repResult'));
    }  
}
