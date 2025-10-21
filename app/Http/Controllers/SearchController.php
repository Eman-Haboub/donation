<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Family;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = Family::query()->with('needs');

        if ($request->region) {
            $query->where('public_region', $request->region);
        }

        if ($request->members_count) {
            if ($request->members_count === 'small') {
                $query->where('members_count', '<=', 3);
            } elseif ($request->members_count === 'medium') {
                $query->whereBetween('members_count', [4, 6]);
            } else {
                $query->where('members_count', '>=', 7);
            }
        }

        if ($request->category) {
            $query->whereHas('needs', function($q) use ($request) {
                $q->where('type', $request->category);
            });
        }

        $families = $query->get();

        return view('pages.search_results', compact('families'));
    }
}
