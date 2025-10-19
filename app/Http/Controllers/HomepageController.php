<?php

namespace App\Http\Controllers;

use App\Models\Family;

use App\Models\News;
class HomepageController extends Controller
{
    public function index()
    {
        $families = Family::where('status', 'active')
            ->latest()   // يرتبهم بالأحدث
            ->take(6)    // ياخد 6 بس
            ->get();

        $news = News::latest()->take(3)->get();
        // إرسالها للواجهة
        return view('pages.home', compact('families','news'));
    }
}
