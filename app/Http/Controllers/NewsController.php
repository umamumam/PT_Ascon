<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->get();
        return view('news.admin', compact('news'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
            'author' => 'nullable|string|max:100',
            'read_time' => 'nullable|integer|min:1',
        ]);

        $slug = Str::slug($request->title);
        $count = News::where('slug', 'like', $slug . '%')->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/news'), $filename);
            $imagePath = 'uploads/news/' . $filename;
        }

        News::create([
            'title' => $request->title,
            'slug' => $slug,
            'author' => $request->author ?? 'Admin',
            'image_path' => $imagePath,
            'content' => $request->content,
            'read_time' => $request->read_time ?? 1,
        ]);

        return redirect()->route('cms.news.index')->with('success', 'News article created successfully.');
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
            'author' => 'nullable|string|max:100',
            'read_time' => 'nullable|integer|min:1',
        ]);

        $imagePath = $news->image_path;
        if ($request->hasFile('image')) {
            if ($imagePath && File::exists(public_path($imagePath))) {
                File::delete(public_path($imagePath));
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/news'), $filename);
            $imagePath = 'uploads/news/' . $filename;
        }

        $slug = $news->slug;
        if ($news->title !== $request->title) {
            $slug = Str::slug($request->title);
            $count = News::where('slug', 'like', $slug . '%')->where('id', '!=', $news->id)->count();
            if ($count > 0) {
                $slug = $slug . '-' . ($count + 1);
            }
        }

        $news->update([
            'title' => $request->title,
            'slug' => $slug,
            'author' => $request->author ?? 'Admin',
            'image_path' => $imagePath,
            'content' => $request->content,
            'read_time' => $request->read_time ?? 1,
        ]);

        return redirect()->route('cms.news.index')->with('success', 'News article updated successfully.');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        if ($news->image_path && File::exists(public_path($news->image_path))) {
            File::delete(public_path($news->image_path));
        }
        $news->delete();

        return redirect()->route('cms.news.index')->with('success', 'News article deleted successfully.');
    }
}
