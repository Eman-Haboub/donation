<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Family;
use App\Models\Need;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $families = Family::latest()->take(6)->get();
        return view('family.index', compact('families'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('family.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'alias'=>'required|string|max:255',
        'public_region'=>'required|string|max:255',
        'members_count'=>'required|integer',
        'information'=>'required|string',
        'status'=>'required|string',
        'goal'=>'nullable|numeric',
        'donated'=>'nullable|numeric',
        'real_name'=>'required|string|max:255',
        'address'=>'required|string',
        'phone'=>'nullable|string',
        'income'=>'nullable|numeric',
        'notes'=>'nullable|string',
        'national_id_encrypted'=>'nullable|string',
        'img'=>'nullable|image',
        'kyc_documents.*'=>'nullable|file',
        'type'=>'required|string',
        'need_description'=>'required|string',
    ]);

    if($request->hasFile('img')){
        $validatedData['img'] = $request->file('img')->store('families','public');
    }

    $family = Family::create($validatedData);

    \App\Models\Need::create([
        'family_id' => $family->id,
        'type' => $request->type,
        'description' => $request->need_description,
    ]);

    return redirect()->route('families.index')->with('success','Family and need created successfully!');
}


    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     $family = Family::with('needs')->findOrFail($id);
    //     return view('family.show', compact('family'));
    // }
public function show($id)
{
    $family = Family::with('needs')->findOrFail($id);

    // جلب المحفظة الخاصة بالعائلة أو إنشاؤها
    $wallet = \App\Models\Wallet::firstOrCreate(
        ['family_id' => $family->id],
        ['balance' => 0]
    );

    // جلب آخر العمليات (تبرعات واردة)
    $transactions = $wallet->transactions()->latest()->get();

    return view('family.show', compact('family', 'wallet', 'transactions'));
}



    /**
     * Show the form for editing the specified resource.
     */
public function edit(string $id)
{
    // جلب العائلة مع الحاجة
    $family = Family::with('needs')->findOrFail($id);

    // جلب الحاجة الأولى (إذا كانت موجودة)
    $familyNeed = $family->needs->first();

    return view('family.create', compact('family', 'familyNeed'));
}


    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'alias'=>'required|string|max:255',
        'public_region'=>'required|string|max:255',
        'members_count'=>'required|integer',
        'information'=>'required|string',
        'status'=>'required|string',
        'goal'=>'nullable|numeric',
        'donated'=>'nullable|numeric',
        'real_name'=>'required|string|max:255',
        'address'=>'required|string',
        'phone'=>'nullable|string',
        'income'=>'nullable|numeric',
        'notes'=>'nullable|string',
        'national_id_encrypted'=>'nullable|string',
        'img'=>'nullable|image',
        'kyc_documents.*'=>'nullable|file',
        'type'=>'required|string',
        'need_description'=>'required|string',
    ]);

    $family = Family::findOrFail($id);

    if($request->hasFile('img')){
        $validatedData['img'] = $request->file('img')->store('families','public');
    }

    $family->update($validatedData);

    // تحديث الحاجة الخاصة بالعائلة
    $need = $family->needs()->first();
    if($need){
        $need->update([
            'type' => $request->type,
            'description' => $request->need_description,
        ]);
    } else {
        $family->needs()->create([
            'type' => $request->type,
            'description' => $request->need_description,
        ]);
    }

    return redirect()->route('families.index')->with('success','Family updated successfully!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $family = Family::findOrFail($id);
        $family->delete();
        return redirect()->route('families.index')->with('success', 'تم حذف الأسرة بنجاح');
    }
}
