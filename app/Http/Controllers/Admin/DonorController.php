<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DonorController extends Controller
{
    public function index() {
        $donors = User::where('role', 'donor')->get();
        return view('admin.donors.index', compact('donors'));
    }

    public function destroy(User $donor) {
        $donor->delete();
        return redirect()->route('admin.donors.index')->with('success', 'Donor deleted successfully.');
    }
}
