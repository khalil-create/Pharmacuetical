<?php

namespace App\Http\Controllers\Managers\marketing;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Uses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsesController extends Controller
{
    public function getItemUses($id)
    { 
        $item = Item::with('uses')->find($id);
        // $itemName = $item->commercial_name;
        if(!$item)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        $uses = $item->uses;
        if($uses->count() < 1)
            return view('managers.marketing.itemUses')->with('item',$item)->with(['error' => 'لم يتم اضافة اي استخدام لهذا الصنف ']);
        return view('managers.marketing.itemUses')->with('item',$item);
    }
    public function addUse($id)
    {
        return view('managers.marketing.addUse')->with('id',$id);
    }
    public function addUseExist($id)
    {
        $uses = Uses::all();
        return view('managers.marketing.addUsesExist')->with('uses',$uses)->with('id',$id);
    }
    public function storeUse(Request $request)
    {
        $request->validate([
            'use' => 'required|string|max:255',
        ]);
        $use = Uses::create([
            'use' => $request->use,
        ]); 
        $use->items()->attach($request->id);
        return redirect('/managerMarketing/itemUses/'.$request->id)->with('status','تم إضافة البيانات بشكل ناجح');
    }
    public function storeUsesExist(Request $request)
    {
        $request->validate([
            'usesIds' => 'required|max:255',
        ]);
        $item = Item::find($request->id);
        $item->uses()->syncWithoutDetaching($request->usesIds);
        return redirect('/managerMarketing/itemUses/'.$request->id)->with('status','تم إضافة البيانات بشكل ناجح');
    }
    public function editUse($id)
    {
        $use = Uses::find($id); 
        if($use->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        return view('managers.marketing.editUse', compact('use',$use));
    }
    public function updateUse(Request $request,$id)
    {
        $request->validate([
            'use' => 'required|string|max:255',
        ]);
        $use = Uses::find($id);
        if($use->items->first()->category_id != null)
            $have_category = 1;
        else
            $have_category = 0;
        $use->use = $request->use;
        $use->update();
        return redirect('/managerMarketing/manageItem/'.$have_category)->with('status','تم تعديل البيانات بشكل ناجح');
    }
    public function deleteUse($id)
    {
        $use = Uses::findOrfail($id);
        if($use->count() < 1)
            return redirect()->back()->with(['error' => 'هذه البيانات غير موجوده ']);
        
        $use->items()->detach();

        return response()->json(['status' => 'تم حذف البيانات بشكل ناجح']);
        // return redirect()->back()->with('status','تم حذف البيانات بشكل ناجح');
    }
}
