<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::check() && (Auth::user()->role == 'family' || Auth::user()->role == 'admin')) {
            return view('family.create');
        } else {
            return redirect()->route('login');
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ التحقق من البيانات القادمة من النموذج
        $validatedData = $request->validate([
            'alias' => 'required|string|max:255',
            'public_region' => 'required|string|max:255',
            'members_count' => 'required|integer|min:1',
            'information' => 'required|string',
            'status' => 'required|string|in:active,inactive,suspended',
            'goal' => 'nullable|numeric|min:0',
            'donated' => 'nullable|numeric|min:0',
            'real_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'income' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'national_id_encrypted' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kyc_documents.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'type' => 'required|string',
            'need_description' => 'required|string',
        ]);

        // 🧍‍♂️ ربط العائلة بالمستخدم الحالي
        $validatedData['user_id'] = Auth::id();

        // 🖼️ تخزين الصورة إن وُجدت
        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('home', 'public');
            $validatedData['img'] = 'storage/' . $path;
        }
        $validatedData['user_id'] = Auth::id();

        // 📝 إنشاء سجل العائلة
        $family = Family::create($validatedData);

        // 📄 إنشاء الحاجة (need) الخاصة بالعائلة
        $family->needs()->create([
            'type' => $request->type,
            'description' => $request->need_description,
        ]);

        // 🔙 العودة مع رسالة نجاح
        return redirect()
            ->route('families.show', $family->id)
            ->with('success', 'Family created successfully!');
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
    public function edit($id)
    {
        // 🟢 جلب العائلة مع الحاجات
        $family = Family::with('needs')->findOrFail($id);

        // 🛡️ السماح فقط للأسرة صاحبة الحساب بتعديل بياناتها
        if (auth()->id() !== $family->user_id) {
            return redirect()->route('families.show', $id)->with('error', 'Unauthorized access.');
        }

        // 🟡 جلب أول حاجة للعائلة إن وجدت
        $familyNeed = $family->needs->first();

        // 🟢 عرض نفس صفحة الإنشاء (create) لكن بمعلومات الأسرة الحالية
        return view('family.create', compact('family', 'familyNeed'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // ✅ التحقق من القيم
        $validatedData = $request->validate([
            'alias' => 'required|string|max:255',
            'public_region' => 'required|string|max:255',
            'members_count' => 'required|integer|min:1',
            'information' => 'required|string',
            'status' => 'required|string|in:active,inactive,suspended',
            'goal' => 'nullable|numeric|min:0',
            'donated' => 'nullable|numeric|min:0',
            'real_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'income' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'national_id_encrypted' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'kyc_documents.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'type' => 'required|string',
            'need_description' => 'required|string',
        ]);

        $family = Family::findOrFail($id);

        // 🛡️ التحقق أن المستخدم الحالي هو صاحب العائلة
        if (auth()->id() !== $family->user_id) {
            return redirect()->route('families.show', $id)->with('error', 'Unauthorized access.');
        }

        // 🟡 تحديث الصورة إن وُجدت
        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('home', 'public');
            $validatedData['img'] = 'storage/' . $path;
        }

        // 🔵 تحديث بيانات الأسرة (بدون إنشاء سجل جديد)
        $family->update($validatedData);

        // 🟢 تحديث الحاجة الخاصة بالعائلة
        $need = $family->needs()->first();

        if ($need) {
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

        // 🔙 العودة إلى صفحة عرض الأسرة مع تنبيه نجاح
        return redirect()
            ->route('families.show', $family->id)
            ->with('success', 'Family information updated successfully!');
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
