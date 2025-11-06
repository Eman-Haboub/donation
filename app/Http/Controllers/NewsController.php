<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // FRONTEND
    // FRONTEND
public function all()
{
    $news = News::latest()->paginate(9); // عرض 9 أخبار لكل صفحة
    return view('admin.news.index', compact('news'));
}

    public function index()
    {
        $news = News::latest()->take(3)->get();
        return view('admin.news.index', compact('news'));
    }

    public function show($id)
    {
        $item = News::findOrFail($id);
        return view('news.show', compact('item'));
    }
// DASHBOARD (CRUD)
public function adminIndex()
{
    $news = News::latest()->paginate(10); // 10 أخبار لكل صفحة
    return view('Admin.news.index', compact('news'));
}

    // DASHBOARD (CRUD)
    public function create()
    {
        return view('Admin.news.create');
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
        return view('Admin.news.edit', compact('item'));
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

        return redirect()->route('admin.dashboard')->with('success', 'News updated successfully!');
    }

    public function destroy($id)
    {
        $item = News::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.dashboard')->with('success', 'News deleted successfully!');
    }
}
