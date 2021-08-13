<?php

namespace App\Http\Controllers\Representatives\Science;
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
        $samples = Sample::where('representative_id',Auth::user()->representatives->id)->whereNotNull(['supervisor_id','representative_id'])->get();
        return view('representatives.repScience.manageSamples',compact('samples',$samples));
    }
}
