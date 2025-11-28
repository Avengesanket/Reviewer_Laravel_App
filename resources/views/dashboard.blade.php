@extends('layout')

@section('content')

<!-- Header -->
<div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-4">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">My Journal</h1>
        <p class="text-gray-500 mt-1">Manage and track your personal reviews.</p>
    </div>
    <a href="{{ route('reviews.create') }}" class="flex items-center gap-2 bg-gray-900 hover:bg-black text-white px-5 py-2.5 rounded-xl font-medium transition shadow-lg shadow-gray-900/20">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
        Log Review
    </a>
</div>

<!-- Search and Filter Bar -->
<div class="flex flex-col lg:flex-row justify-between items-center border-b border-gray-200 pb-6 mb-8 gap-4">
    
    <!-- Search and Type Filter -->
    <div class="w-full lg:w-5/12">
        <form action="{{ route('dashboard') }}" method="GET" class="flex shadow-sm rounded-lg border border-gray-300 overflow-hidden focus-within:ring-2 focus-within:ring-blue-200 focus-within:border-blue-500 transition">
             @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif
             
             <!-- Type Dropdown -->
             <div class="relative bg-gray-50 border-r border-gray-300">
                <select name="type" class="h-full pl-3 pr-8 py-2 text-sm text-gray-600 bg-transparent outline-none cursor-pointer appearance-none hover:bg-gray-100">
                    <option value="All">All Types</option>
                    <option value="Movie" {{ request('type') == 'Movie' ? 'selected' : '' }}>Movies</option>
                    <option value="Book" {{ request('type') == 'Book' ? 'selected' : '' }}>Books</option>
                    <option value="Game" {{ request('type') == 'Game' ? 'selected' : '' }}>Games</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>

            <!-- Search Input -->
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search my reviews..." 
                   class="w-full pl-3 pr-3 py-2 outline-none text-sm text-gray-700 placeholder-gray-400">
            
            <button type="submit" class="bg-gray-50 px-3 border-l border-gray-300 text-gray-500 hover:text-blue-600 hover:bg-gray-100 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </button>
        </form>
    </div>

    <!-- Sort Filters -->
    <div class="flex items-center gap-2">
        <span class="text-sm font-semibold text-gray-500 mr-2 uppercase tracking-wider hidden md:inline">Sort:</span>
        
        <a href="{{ request()->fullUrlWithQuery(['sort' => 'date_desc']) }}" 
           class="flex items-center gap-2 px-4 py-1.5 rounded-lg text-sm font-medium transition
           {{ request('sort') == 'date_desc' || !request('sort') ? 'bg-gray-100 text-gray-900 ring-1 ring-gray-200' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Recent
        </a>

        <a href="{{ request()->fullUrlWithQuery(['sort' => 'rating_desc']) }}" 
           class="flex items-center gap-2 px-4 py-1.5 rounded-lg text-sm font-medium transition
           {{ request('sort') == 'rating_desc' ? 'bg-gray-100 text-gray-900 ring-1 ring-gray-200' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363 1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
            High Score
        </a>
    </div>
</div>

<div class="space-y-4 mb-12">
    @forelse($reviews as $review)
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:border-blue-100 transition-colors flex flex-col md:flex-row gap-6 relative overflow-hidden group">
            
            <div class="absolute left-0 top-0 bottom-0 w-1.5 {{ $review->is_public ? 'bg-green-500' : 'bg-gray-300' }}"></div>

            <div class="hidden md:flex flex-col items-center justify-center shrink-0 w-20 h-20 bg-gray-50 rounded-xl group-hover:bg-blue-50 transition-colors">
                <span class="text-2xl font-bold text-gray-800 group-hover:text-blue-600">{{ $review->rating }}</span>
                <span class="text-xs text-gray-400 uppercase font-semibold">Score</span>
            </div>

            <div class="grow">
                <div class="flex justify-between items-start mb-2 gap-4">
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-3 mb-1">
                            <h3 class="font-bold text-xl text-gray-900 leading-tight">{{ $review->title }}</h3>
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide
                                {{ $review->is_public ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ $review->is_public ? 'Public' : 'Private' }}
                            </span>
                        </div>
                        <p class="text-xs text-gray-500 font-medium">
                            {{ $review->type }} 
                            @if($review->genre) • {{ $review->genre }} @endif
                            • Consumed {{ \Carbon\Carbon::parse($review->consumed_at)->format('M d, Y') }}
                        </p>
                    </div>
                    <div class="md:hidden bg-gray-100 px-3 py-1 rounded-lg font-bold text-gray-700">
                        {{ $review->rating }}
                    </div>
                </div>

                <p class="text-gray-700 leading-relaxed mt-3 text-sm">{{ $review->body }}</p>

                <div class="mt-4 pt-4 border-t border-gray-50 flex justify-between items-center">
                    <div class="text-xs text-gray-400 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Posted {{ $review->created_at->diffForHumans() }}
                        @if($review->wasEdited())
                            <span class="text-blue-500 font-medium ml-1">(Edited)</span>
                        @endif
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('reviews.edit', $review) }}" class="text-gray-500 hover:text-blue-600 text-xs font-bold uppercase transition">Edit</a>
                        <span class="text-gray-300">|</span>
                        <form action="{{ route('reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('Delete this review?');">
                            @csrf @method('DELETE')
                            <button class="text-gray-400 hover:text-red-600 text-xs font-bold uppercase transition">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-20 bg-white rounded-2xl border border-dashed border-gray-300">
            <h3 class="text-lg font-semibold text-gray-900">No reviews found</h3>
            <p class="text-gray-500 mb-6">Try adjusting your filters or write something new.</p>
            @if(request()->anyFilled(['search', 'type']))
                <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline">Clear Filters</a>
            @else
                <a href="{{ route('reviews.create') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-full font-medium hover:bg-blue-700 transition">Write First Review</a>
            @endif
        </div>
    @endforelse
</div>

<!-- Pagination Links -->
<div class="mt-8 mb-12">
    {{ $reviews->links('pagination::tailwind') }}
</div>
@endsection