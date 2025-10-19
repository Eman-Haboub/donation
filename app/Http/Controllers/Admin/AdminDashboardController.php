<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Family;
use App\Models\User;
use App\Models\WalletTransaction;

class AdminDashboardController extends Controller
{
    public function index() {
        $totalFamilies = Family::count();
        $totalDonors = User::where('role', 'donor')->count();
        $totalDonations = WalletTransaction::where('type', 'donation')->sum('amount');

        $recentFamilies = Family::latest()->take(5)->get();
        $recentDonors = User::where('role', 'donor')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalFamilies',
            'totalDonors',
            'totalDonations',
            'recentFamilies',
            'recentDonors'
        ));
    }
}
