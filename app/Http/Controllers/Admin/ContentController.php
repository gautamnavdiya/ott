<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::latest()->paginate(15);
        return view('admin.content.index', compact('contents'));
    }

    public function create()
    {
        return view('admin.content.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:movie,series,documentary',
            'genre' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|mimes:mp4,avi,mov,wmv|max:10240',
            'release_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'duration' => 'nullable|integer|min:1',
            'rating' => 'nullable|numeric|min:0|max:10',
            'language' => 'nullable|string|max:255',
            'is_trending' => 'boolean',
            'is_featured' => 'boolean',
            'is_top_pick' => 'boolean',
        ]);

        // Handle file uploads
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }
        if ($request->hasFile('poster')) {
            $validated['poster'] = $request->file('poster')->store('posters', 'public');
        }
        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')->store('banners', 'public');
        }
        if ($request->hasFile('video')) {
            $validated['video'] = $request->file('video')->store('videos', 'public');
        }

        $validated['is_trending'] = $request->has('is_trending');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_top_pick'] = $request->has('is_top_pick');

        Content::create($validated);

        return redirect()->route('admin.content.index')->with('success', 'Content created successfully!');
    }

    public function edit(Content $content)
    {
        return view('admin.content.edit', compact('content'));
    }

    public function update(Request $request, Content $content)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:movie,series,documentary',
            'genre' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|mimes:mp4,avi,mov,wmv|max:10240',
            'release_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'duration' => 'nullable|integer|min:1',
            'rating' => 'nullable|numeric|min:0|max:10',
            'language' => 'nullable|string|max:255',
            'is_trending' => 'boolean',
            'is_featured' => 'boolean',
            'is_top_pick' => 'boolean',
        ]);

        // Handle file uploads
        if ($request->hasFile('thumbnail')) {
            if ($content->thumbnail) {
                Storage::disk('public')->delete($content->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }
        if ($request->hasFile('poster')) {
            if ($content->poster) {
                Storage::disk('public')->delete($content->poster);
            }
            $validated['poster'] = $request->file('poster')->store('posters', 'public');
        }
        if ($request->hasFile('banner')) {
            if ($content->banner) {
                Storage::disk('public')->delete($content->banner);
            }
            $validated['banner'] = $request->file('banner')->store('banners', 'public');
        }
        if ($request->hasFile('video')) {
            if ($content->video) {
                Storage::disk('public')->delete($content->video);
            }
            $validated['video'] = $request->file('video')->store('videos', 'public');
        }

        $validated['is_trending'] = $request->has('is_trending');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_top_pick'] = $request->has('is_top_pick');

        $content->update($validated);

        return redirect()->route('admin.content.index')->with('success', 'Content updated successfully!');
    }

    public function destroy(Content $content)
    {
        // Delete associated files
        if ($content->thumbnail) {
            Storage::disk('public')->delete($content->thumbnail);
        }
        if ($content->poster) {
            Storage::disk('public')->delete($content->poster);
        }
        if ($content->banner) {
            Storage::disk('public')->delete($content->banner);
        }
        if ($content->video) {
            Storage::disk('public')->delete($content->video);
        }

        $content->delete();

        return redirect()->route('admin.content.index')->with('success', 'Content deleted successfully!');
    }
}
