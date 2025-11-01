<?php

namespace App\Http\Controllers;
use App\Models\Family;
use App\Models\Need;

use Illuminate\Http\Request;

class FamilyAIController extends Controller

{
    // دالة حساب درجات الأولوية
    public function priorityScores()
    {
        // 1️⃣ جلب كل الأسر من قاعدة البيانات
        $families = Family::all();

        foreach ($families as $family) {
            // 2️⃣ قاعدة أساسية: عدد الأفراد
            $score = $family->members_count;

            // 3️⃣ نسبة الحاجة المتبقية
            $need_ratio = ($family->goal - $family->donated) / $family->goal;
            $score += $need_ratio * 10; // نضرب لزيادة تأثيرها

            // 4️⃣ حالة الطوارئ
            if ($family->emergency == 'high') {
                $score += 5;
            } elseif ($family->emergency == 'medium') {
                $score += 3;
            }

            // 5️⃣ تخزين درجة الأولوية في متغير جديد
            $family->priority_score = $score;
        }

        // 6️⃣ ترتيب الأسر حسب الأولوية الأعلى أولًا
        $families = $families->sortByDesc('priority_score');

        // 7️⃣ إعادة النتيجة بصيغة JSON لسهولة العرض
        return response()->json($families);
    }
public function smartAlerts()
{
    $alerts = [];

    $families = Family::all();

    foreach ($families as $family) {
        $needs = $family->needs; // يفترض أن هناك علاقة hasMany في Model Family

        foreach ($needs as $need) {
            $need_percentage = ($need->goal - $need->donated) / $need->goal * 100;

            if ($need_percentage > 50) {
                $alerts[] = "الأسرة {$family->name} بحاجة ماسة لنوع المساعدة: {$need->type}!";
            }
        }
    }

    // مثال: عدد الأسر بحاجة طعام أكثر من 2
    $food_needed = Need::where('type', 'food')
                    ->whereRaw('(goal - donated) > ?', [50])
                    ->count();

    if ($food_needed > 2) {
        $alerts[] = "هناك ارتفاع في الحاجة لنوع المساعدات: طعام!";
    }

    return response()->json($alerts);
}
public function adminAIView()
{
    $families = Family::with('needs')->get();

    // 1️⃣ حساب درجات الأولوية لكل أسرة
    foreach ($families as $family) {
        $score = $family->members_count;

        // عدد الاحتياجات غير المكتملة
        $unfulfilled_needs = $family->needs->where('fulfilled', false)->count();
        $score += $unfulfilled_needs * 5; // كل حاجة غير مكتملة تضيف 5 نقاط

        // حالة الطوارئ
        if ($family->emergency == 'high') $score += 5;
        elseif ($family->emergency == 'medium') $score += 3;

        $family->priority_score = $score;
    }

    $families = $families->sortByDesc('priority_score');

    // 2️⃣ حساب التنبيهات الذكية
    $alerts = [];
    foreach ($families as $family) {
        foreach ($family->needs as $need) {
            if (!$need->fulfilled) {
                $alerts[] = "الأسرة {$family->name} بحاجة لمساعدة: {$need->type}!";
            }
        }
    }

    // مثال: إذا أكثر من 2 حاجة طعام غير مكتملة
    $food_needed = Need::where('type', 'food')->where('fulfilled', false)->count();
    if ($food_needed > 2) {
        $alerts[] = "هناك ارتفاع في الحاجة لنوع المساعدات: طعام!";
    }

    return view('admin_ai', compact('families', 'alerts'));
}
public function adminAIData()
{
    $families = Family::with('needs')->get();

    foreach ($families as $family) {
        $score = $family->members_count;
        $unfulfilled_needs = $family->needs->where('fulfilled', false)->count();
        $score += $unfulfilled_needs * 5;

        if ($family->emergency == 'high') $score += 5;
        elseif ($family->emergency == 'medium') $score += 3;

        $family->priority_score = $score;
    }

    $families = $families->sortByDesc('priority_score')->values();

    $alerts = [];
    foreach ($families as $family) {
        foreach ($family->needs as $need) {
            if (!$need->fulfilled) {
                $alerts[] = "الأسرة {$family->name} بحاجة لمساعدة: {$need->type}!";
            }
        }
    }

    $food_needed = Need::where('type','food')->where('fulfilled',false)->count();
    if ($food_needed > 2) {
        $alerts[] = "هناك ارتفاع في الحاجة لنوع المساعدات: طعام!";
    }

    return response()->json([
        'families' => $families,
        'alerts' => $alerts
    ]);
}

}
