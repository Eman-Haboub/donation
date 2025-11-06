<?php

namespace App\Http\Controllers;
use App\Models\Family;
use App\Models\Need;

use Illuminate\Http\Request;

class FamilyAIController extends Controller

{
    public function priorityScores()
    {
        $families = Family::all();

        foreach ($families as $family) {
            $score = $family->members_count;

            $need_ratio = ($family->goal - $family->donated) / $family->goal;
            $score += $need_ratio * 10;

            if ($family->emergency == 'high') {
                $score += 5;
            } elseif ($family->emergency == 'medium') {
                $score += 3;
            }

            $family->priority_score = $score;
        }

        $families = $families->sortByDesc('priority_score');

        return response()->json($families);
    }
public function smartAlerts()
{
    $alerts = [];

    $families = Family::all();

    foreach ($families as $family) {
        $needs = $family->needs;

        foreach ($needs as $need) {
            $need_percentage = ($need->goal - $need->donated) / $need->goal * 100;

            if ($need_percentage > 50) {
                $alerts[] = "الأسرة {$family->name} بحاجة ماسة لنوع المساعدة: {$need->type}!";
            }
        }
    }

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

    foreach ($families as $family) {
        $score = $family->members_count;

        $unfulfilled_needs = $family->needs->where('fulfilled', false)->count();
        $score += $unfulfilled_needs * 5;
        if ($family->emergency == 'high') $score += 5;
        elseif ($family->emergency == 'medium') $score += 3;

        $family->priority_score = $score;
    }

    $families = $families->sortByDesc('priority_score');

    $alerts = [];
    foreach ($families as $family) {
        foreach ($family->needs as $need) {
            if (!$need->fulfilled) {
                $alerts[] = "الأسرة {$family->name} بحاجة لمساعدة: {$need->type}!";
            }
        }
    }

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
