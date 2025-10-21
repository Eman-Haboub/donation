<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Family;

class FamilyController extends Controller
{
    public function index() {
        $families = Family::paginate(10);
        return view('admin.families.index', compact('families'));
    }

      public function create()
    {
        return view('admin.families.create');
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

        return redirect()->route('admin.families.index')->with('success','Family and need created successfully!');
    }

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

        return view('admin.families.show', compact('family', 'wallet', 'transactions'));
    }


    public function edit(string $id)
    {
        // جلب العائلة مع الحاجة
        $family = Family::with('needs')->findOrFail($id);

        // جلب الحاجة الأولى (إذا كانت موجودة)
        $familyNeed = $family->needs->first();

        return view('admin.families.create', compact('family', 'familyNeed'));
    }



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

        return redirect()->route('admin.families.index')->with('success','Family updated successfully!');
    }

    public function destroy(Family $family) {
        $family->delete();
        return redirect()->route('admin.families.index')->with('success', 'Family deleted successfully.');
    }
}
