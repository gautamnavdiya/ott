@extends('admin.layout')

@section('title', 'Add New Content')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold">Add New Content</h1>
    <p class="text-gray-400 mt-2">Upload videos, images, and add content details</p>
</div>

<form action="{{ route('admin.content.store') }}" method="POST" enctype="multipart/form-data" class="bg-gray-800 rounded-lg shadow-xl p-6">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Left Column -->
        <div class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Title *</label>
                <input type="text" name="title" value="{{ old('title') }}" required
                       class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500">
                @error('title')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                <textarea name="description" rows="4"
                          class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Type *</label>
                <select name="type" required
                        class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500">
                    <option value="movie" {{ old('type') == 'movie' ? 'selected' : '' }}>Movie</option>
                    <option value="series" {{ old('type') == 'series' ? 'selected' : '' }}>Series</option>
                    <option value="documentary" {{ old('type') == 'documentary' ? 'selected' : '' }}>Documentary</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Genre</label>
                <input type="text" name="genre" value="{{ old('genre') }}"
                       placeholder="Action, Drama, Comedy, etc."
                       class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Release Year</label>
                    <input type="number" name="release_year" value="{{ old('release_year') }}" min="1900" max="{{ date('Y') }}"
                           class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Duration (minutes)</label>
                    <input type="number" name="duration" value="{{ old('duration') }}" min="1"
                           class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Rating (0-10)</label>
                    <input type="number" name="rating" value="{{ old('rating', 0) }}" step="0.1" min="0" max="10"
                           class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Language</label>
                    <input type="text" name="language" value="{{ old('language', 'English') }}"
                           class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500">
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Thumbnail Image</label>
                <input type="file" name="thumbnail" accept="image/*"
                       class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500">
                <p class="text-xs text-gray-400 mt-1">Recommended: 400x600px, Max: 2MB</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Poster Image</label>
                <input type="file" name="poster" accept="image/*"
                       class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500">
                <p class="text-xs text-gray-400 mt-1">Recommended: 800x1200px, Max: 2MB</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Banner Image</label>
                <input type="file" name="banner" accept="image/*"
                       class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500">
                <p class="text-xs text-gray-400 mt-1">Recommended: 1920x1080px, Max: 2MB</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Video File</label>
                <input type="file" name="video" accept="video/*"
                       class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500">
                <p class="text-xs text-gray-400 mt-1">Supported: MP4, AVI, MOV, WMV, Max: 10MB</p>
            </div>

            <div class="bg-gray-700 p-4 rounded-lg">
                <label class="block text-sm font-medium text-gray-300 mb-3">Content Flags</label>
                <div class="space-y-2">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                               class="rounded border-gray-600 text-red-600 focus:ring-red-500">
                        <span class="ml-2 text-gray-300">Featured</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="is_trending" value="1" {{ old('is_trending') ? 'checked' : '' }}
                               class="rounded border-gray-600 text-red-600 focus:ring-red-500">
                        <span class="ml-2 text-gray-300">Trending</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="is_top_pick" value="1" {{ old('is_top_pick') ? 'checked' : '' }}
                               class="rounded border-gray-600 text-red-600 focus:ring-red-500">
                        <span class="ml-2 text-gray-300">Top Pick</span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8 flex justify-end space-x-4">
        <a href="{{ route('admin.content.index') }}" class="px-6 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg">
            Cancel
        </a>
        <button type="submit" class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold">
            Create Content
        </button>
    </div>
</form>
@endsection

