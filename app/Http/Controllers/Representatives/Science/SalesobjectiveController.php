<?php

namespace App\Http\Controllers\Representatives\Science;
use App\Models\Salesobjective;
use App\Models\Item;
use App\Http\Controllers\Controller;
use App\Models\Supervisor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Traits\userTrait;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class SalesobjectiveController extends Controller
{
    use userTrait;
    public function home()
    {
        return view('managers.marketing.home');
    }
    public function getAllSalesObjectives(Request $request)
    {
        if($request->get('id')){
            $this->unreadNotify($request->get('id'));
        }
        $salesObjectives = Salesobjective::where('representative_id',Auth::user()->representatives->id)
        ->whereNotNull('representative_id')->get();
        return view('representatives.repScience.showSalesObjectives',compact('salesObjectives',$salesObjectives));
    }
}
