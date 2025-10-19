<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Family;

class FamilyController extends Controller
{
    public function index() {
        $families = Family::all();
        return view('admin.families.index', compact('families'));
    }

    public function edit(Family $family) {
        return view('admin.families.edit', compact('family'));
    }

    public function update(Request $request, Family $family) {
        $request->validate([
            'alias' => 'required|string|max:255',
            'public_region' => 'required|string|max:255',
            'status' => 'required|in:active,inactive,suspended',
            'members_count' => 'required|integer|min:1',
            'goal' => 'required|numeric|min:0',
        ]);

        $family->update($request->all());

        return redirect()->route('admin.families.index')->with('success', 'Family updated successfully.');
    }

    public function destroy(Family $family) {
        $family->delete();
        return redirect()->route('admin.families.index')->with('success', 'Family deleted successfully.');
    }
}
