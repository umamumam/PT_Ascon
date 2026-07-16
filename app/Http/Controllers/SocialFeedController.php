<?php

namespace App\Http\Controllers;

use App\Models\SocialFeed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SocialFeedController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'tag' => 'required|string|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
            'link' => 'nullable|url',
        ]);

        $imagePath = '';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('feeds', $filename, 'public');
            $imagePath = 'storage/feeds/' . $filename;
        }

        SocialFeed::create([
            'title' => $request->title,
            'tag' => $request->tag,
            'image_path' => $imagePath,
            'link' => $request->link,
        ]);

        return redirect()->route('cms.settings.index', ['tab' => 'feeds'])->with('success', 'Social feed item added successfully.');
    }

    public function update(Request $request, $id)
    {
        $feed = SocialFeed::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'tag' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
            'link' => 'nullable|url',
        ]);

        $imagePath = $feed->image_path;
        if ($request->hasFile('image')) {
            if ($imagePath && File::exists(public_path($imagePath)) && !str_starts_with($imagePath, 'http')) {
                File::delete(public_path($imagePath));
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('feeds', $filename, 'public');
            $imagePath = 'storage/feeds/' . $filename;
        }

        $feed->update([
            'title' => $request->title,
            'tag' => $request->tag,
            'image_path' => $imagePath,
            'link' => $request->link,
        ]);

        return redirect()->route('cms.settings.index', ['tab' => 'feeds'])->with('success', 'Social feed item updated successfully.');
    }

    public function destroy($id)
    {
        $feed = SocialFeed::findOrFail($id);
        if ($feed->image_path && File::exists(public_path($feed->image_path)) && !str_starts_with($feed->image_path, 'http')) {
            File::delete(public_path($feed->image_path));
        }
        $feed->delete();

        return redirect()->route('cms.settings.index', ['tab' => 'feeds'])->with('success', 'Social feed item deleted successfully.');
    }
}
