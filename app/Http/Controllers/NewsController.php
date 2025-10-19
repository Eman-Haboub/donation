<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // FRONTEND
    public function index()
    {
        $news = News::latest()->take(3)->get();
        return view('home', compact('news'));
    }

    public function show($id)
    {
        $item = News::findOrFail($id);
        return view('news.show', compact('item'));
    }

    // DASHBOARD (CRUD)
    public function create()
    {
        return view('dashboard.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'image'   => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'details' => 'required|string',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/news', 'public');
        }

        News::create([
            'title'   => $request->title,
            'image'   => $path,
            'details' => $request->details,
        ]);

        return redirect()->route('home')->with('success', 'News created successfully!');
    }

    public function edit($id)
    {
        $item = News::findOrFail($id);
        return view('dashboard.news.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = News::findOrFail($id);

        $request->validate([
            'title'   => 'required|string|max:255',
            'image'   => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'details' => 'required|string',
        ]);

        $path = $item->image;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/news', 'public');
        }

        $item->update([
            'title'   => $request->title,
            'image'   => $path,
            'details' => $request->details,
        ]);

        return redirect()->route('home')->with('success', 'News updated successfully!');
    }

    public function destroy($id)
    {
        $item = News::findOrFail($id);
        $item->delete();

        return redirect()->route('home')->with('success', 'News deleted successfully!');
    }
}
