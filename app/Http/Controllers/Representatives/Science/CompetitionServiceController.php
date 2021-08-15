<?php

namespace App\Http\Controllers\Representatives\Science;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\CompetitionService;
use App\Models\Competitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\userTrait;

class CompetitionServiceController extends Controller
{
    use userTrait;
    public function getAllCompetitionServices()
    {
        $competitors = Competitor::where('representative_id',Auth::user()->representatives->id)->with('CompetitionService')->whereHas('CompetitionService')->get();
        return view('representatives.repScience.manageCompetitionServices',compact('competitors'));
    }
    public function addCompetitionService()
    {
        return view('representatives.repScience.addCompetitionService');
    }
    public function storeCompetitionService(Request $request)
    {
        $rules = $this->getRules();
        $messages = $this->getMessages();
        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        $comp = Competitor::create([
            'item_name' => $request->item_name,
            'representative_id' => Auth::user()->representatives->id,
            ]);
        CompetitionService::create([
            'type' => $request->type,
            'service_goal' => $request->service_goal,
            'service_period' => $request->service_period,
            'source' => $request->source,
            'competitor_id' => $comp->id,
            ]);
        
        return redirect('/repScience/manageCompetitionServices')->with('status','تم إضافة البيانات بشكل ناجح');
    }
    protected function getRules()
    {
        return $rules = [
                'item_name' => 'required|string|max:255',
                'service_goal' => 'required|string|max:255',
                'service_period' => 'required|string|max:255',
                'source' => 'required|string|max:255',
            ];
    }
    protected function getMessages()
    {
        return $messages = [
            'item_name.required' => 'يجب عليك كتابة هذا الحقل',
            'item_name.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'item_name.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',
            
            'service_goal.required' => 'يجب عليك كتابة هذا الحقل',
            'service_goal.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'service_goal.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',

            'service_period.required' => 'يجب عليك كتابة هذا الحقل',
            'service_period.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'service_period.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',

            'source.required' => 'يجب عليك كتابة هذا الحقل',
            'source.string' => 'يجب ان يكون هذا الحقل نص وليس رقم',
            'source.max' => 'يجب ان لايتجاوز عدد الاحرف اكثر من 255',
        ];
    }
    public function editCompetitionService($id)
    {
        $service = CompetitionService::find($id); 
        if($service->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        return view('representatives.repScience.editCompetitionService', compact('service'));
    }
    public function updateCompetitionService(Request $request,$id)
    {
        $competitionService = CompetitionService::find($id);
        $competitor = Competitor::find($competitionService->competitor->id);
        if($competitionService->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);

        $competitor->item_name = $request->item_name;
        $competitor->update();
        $competitionService->type = $request->type;
        $competitionService->service_goal = $request->service_goal;
        $competitionService->service_period = $request->service_period;
        $competitionService->source = $request->source;
        $competitionService->update();
        
        return redirect('/repScience/manageCompetitionServices')->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteCompetitionService($id)
    {
        $competitionService = CompetitionService::findOrfail($id);
        if($competitionService->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $competitionService->delete();

        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
    }
    // public function showCompetitionServiceDetails($id)
    // {
    //     $compServices = CompetitionService::findOrfail($id);
    //     if($compServices->count() < 1)
    //         return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
    //     return view('representatives.repScience.showCompetitionServiceDetails',compact('compServices'));
    // }
}
