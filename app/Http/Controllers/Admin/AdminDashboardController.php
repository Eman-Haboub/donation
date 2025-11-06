<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Family;
use App\Models\User;
use App\Models\Message;
use App\Models\News;
use App\Models\WalletTransaction;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // إحصائيات عامة
        $totalFamilies = Family::count();
        $totalDonors = User::where('role', 'donor')->count();
        $totalDonations = WalletTransaction::where('type', 'donation')->sum('amount');
        $totalNews = News::count();

        // أحدث البيانات (عرض آخر 5 فقط بدون pagination)
        $recentFamilies = Family::latest()->get();
        $recentDonors = User::where('role', 'donor')->latest()->take(5)->get();
        $recentMessages = Message::latest()->take(5)->get();
        $recentNews = News::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalFamilies',
            'totalDonors',
            'totalDonations',
            'totalNews',
            'recentFamilies',
            'recentDonors',
            'recentMessages',
            'recentNews'
        ));
    }
}
