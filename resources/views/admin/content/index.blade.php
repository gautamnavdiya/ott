@extends('admin.layout')

@section('title', 'Content Management')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold">Content Management</h1>
    <a href="{{ route('admin.content.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold">
        + Add New Content
    </a>
</div>

<div class="bg-gray-800 rounded-lg shadow-xl overflow-hidden">
    <table class="min-w-full divide-y divide-gray-700">
        <thead class="bg-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Thumbnail</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Genre</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Rating</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-gray-800 divide-y divide-gray-700">
            @forelse($contents as $content)
            <tr class="hover:bg-gray-750">
                <td class="px-6 py-4 whitespace-nowrap">
                    <img src="{{ $content->thumbnail ? Storage::url($content->thumbnail) : 'https://picsum.photos/100/150?random=' . $content->id }}" 
                         alt="{{ $content->title }}" 
                         class="h-20 w-14 object-cover rounded">
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm font-medium text-white">{{ $content->title }}</div>
                    <div class="text-sm text-gray-400">{{ $content->release_year }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-900 text-blue-200">
                        {{ ucfirst($content->type) }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $content->genre }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-400">★ {{ $content->rating }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex flex-col gap-1">
                        @if($content->is_featured)
                            <span class="px-2 text-xs bg-red-600 text-white rounded">Featured</span>
                        @endif
                        @if($content->is_trending)
                            <span class="px-2 text-xs bg-green-600 text-white rounded">Trending</span>
                        @endif
                        @if($content->is_top_pick)
                            <span class="px-2 text-xs bg-purple-600 text-white rounded">Top Pick</span>
                        @endif
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="{{ route('admin.content.edit', $content) }}" class="text-blue-400 hover:text-blue-300 mr-4">Edit</a>
                    <form action="{{ route('admin.content.destroy', $content) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-400 hover:text-red-300">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-4 text-center text-gray-400">No content found. <a href="{{ route('admin.content.create') }}" class="text-red-500 hover:text-red-400">Create one</a></td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($contents->hasPages())
<div class="mt-6">
    <div class="flex items-center justify-between">
        <div class="text-sm text-gray-400">
            Showing {{ $contents->firstItem() }} to {{ $contents->lastItem() }} of {{ $contents->total() }} results
        </div>
        <div class="flex space-x-2">
            @if ($contents->onFirstPage())
                <span class="px-4 py-2 bg-gray-700 text-gray-500 rounded-lg cursor-not-allowed">Previous</span>
            @else
                <a href="{{ $contents->previousPageUrl() }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg">Previous</a>
            @endif

            @foreach ($contents->getUrlRange(1, $contents->lastPage()) as $page => $url)
                @if ($page == $contents->currentPage())
                    <span class="px-4 py-2 bg-red-600 text-white rounded-lg">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg">{{ $page }}</a>
                @endif
            @endforeach

            @if ($contents->hasMorePages())
                <a href="{{ $contents->nextPageUrl() }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg">Next</a>
            @else
                <span class="px-4 py-2 bg-gray-700 text-gray-500 rounded-lg cursor-not-allowed">Next</span>
            @endif
        </div>
    </div>
</div>
@endif
@endsection

