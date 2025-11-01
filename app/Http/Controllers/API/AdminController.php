<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Family;
use App\Models\Donation;
use App\Models\User;

class AdminController extends Controller
{
    // مثال لتقارير أساسية
    public function reports()
    {
        $totalFamilies = Family::count();
        $totalDonors = User::where('role','donor')->count();
        $totalDonations = Donation::sum('amount');
        $totalPending = Donation::where('status','pending')->sum('amount');

        return response()->json([
            'total_families' => $totalFamilies,
            'total_donors' => $totalDonors,
            'total_donations' => $totalDonations,
            'total_pending_donations' => $totalPending,
        ]);
    }

    // يمكن إضافة أي وظائف أخرى لإدارة النظام مثل:
    // - تعديل/حذف أي أسرة
    // - إدارة المتبرعين
    // - متابعة التبرعات والحسابات
}
