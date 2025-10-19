<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
     public function about()
    {
        return view('pages.about');
    }
      public function privacy()
    {
        return view('pages.privacy');
    }
        public function blog()
    {
        return view('pages.blog');
    }
     public function gallery()
    {
        return view('pages.gallery');
    }
      public function Causes()
    {
        return view('sections.cards');
    }
      public function donate()
    {
        return view('pages.donate');
    }
      public function donation()
    {
        return view('pages.donation');
    }


}
