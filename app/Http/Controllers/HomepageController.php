<?php

namespace App\Http\Controllers;

use App\Models\Family;

use App\Models\News;
class HomepageController extends Controller
{
    public function index()
    {
        $families = Family::where('status', 'active')
            ->latest()  
            ->take(6)
            ->get();

        $news = News::latest()->take(3)->get();
        return view('pages.home', compact('families','news'));
    }
}
