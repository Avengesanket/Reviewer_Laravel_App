@extends('layout')

@section('content')

<!-- Header Section -->
<div class="text-center mb-8">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-2 tracking-tight">Public Reviews</h1>
    <p class="text-lg text-gray-500 max-w-2xl mx-auto">Discover what others are watching, reading, and playing.</p>
</div>

<!-- Search and Filter Bar -->
<div class="flex flex-col lg:flex-row justify-between items-center mb-10 gap-4 max-w-5xl mx-auto">
    
    <!-- Search Form with Type Dropdown -->
    <div class="w-full lg:w-2/3 relative">
        <form action="{{ route('home') }}" method="GET" class="flex shadow-sm rounded-full bg-white border border-gray-300 focus-within:ring-2 focus-within:ring-blue-200 focus-within:border-blue-500 transition overflow-hidden">

            @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif
            
            <!-- Type Dropdown -->
            <div class="relative border-r border-gray-200">
                <select name="type" class="h-full pl-4 pr-8 py-2.5 bg-gray-50 text-sm font-medium text-gray-700 outline-none cursor-pointer hover:bg-gray-100 appearance-none">
                    <option value="All">All Types</option>
                    <option value="Movie" {{ request('type') == 'Movie' ? 'selected' : '' }}>Movies</option>
                    <option value="Book" {{ request('type') == 'Book' ? 'selected' : '' }}>Books</option>
                    <option value="Game" {{ request('type') == 'Game' ? 'selected' : '' }}>Games</option>
                </select>
                <!-- Custom Arrow Icon -->
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>

            <!-- Search Input -->
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search reviews..." 
                class="w-full pl-4 pr-4 py-2.5 outline-none text-sm text-gray-700 placeholder-gray-400">
            
            <!-- Submit Button Icon -->
            <button type="submit" class="pr-4 pl-3 text-gray-400 hover:text-blue-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </button>
        </form>
    </div>

    <!-- Filter Buttons -->
    <div class="bg-white p-1 rounded-full shadow-sm border border-gray-200 inline-flex shrink-0">
        <a href="{{ request()->fullUrlWithQuery(['sort' => 'date_desc']) }}" 
           class="flex items-center gap-2 px-5 py-2 rounded-full text-sm font-semibold transition-all duration-200
           {{ request('sort') == 'date_desc' || !request('sort') ? 'bg-blue-600 text-white shadow-md' : 'text-gray-600 hover:bg-gray-100' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Recent
        </a>

        <a href="{{ request()->fullUrlWithQuery(['sort' => 'rating_desc']) }}" 
           class="flex items-center gap-2 px-5 py-2 rounded-full text-sm font-semibold transition-all duration-200
           {{ request('sort') == 'rating_desc' ? 'bg-blue-600 text-white shadow-md' : 'text-gray-600 hover:bg-gray-100' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363 1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
            Top Rated
        </a>
    </div>
</div>

<!-- Reviews Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
    @forelse($reviews as $review)
        <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden flex flex-col h-full">
            <div class="p-6 grow">
                <div class="flex justify-between items-start mb-5 gap-6">
                    <div class="flex-1">
                        <span class="inline-block px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-gray-500 bg-gray-100 rounded-md mb-3">
                            {{ $review->type }}
                        </span>
                        <h3 class="font-bold text-xl text-gray-900 group-hover:text-blue-600 transition-colors leading-snug">
                            {{ $review->title }}
                        </h3>
                    </div>
                    <div class="shrink-0 flex flex-col items-center justify-center bg-blue-50 text-blue-700 w-14 h-14 rounded-xl font-bold text-xl shadow-sm">
                        <span>{{ $review->rating }}</span>
                    </div>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    {{ Str::limit($review->body, 120) }}
                </p>
            </div>
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex justify-between items-center text-xs text-gray-500">
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 bg-blue-200 rounded-full flex items-center justify-center text-blue-700 font-bold">
                        {{ substr($review->user->name, 0, 1) }}
                    </div>
                    <span>{{ $review->user->name }}</span>
                </div>
                <div class="text-right">
                    <div class="flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ $review->created_at->diffForHumans() }}
                    </div>
                    @if($review->wasEdited())
                        <span class="text-gray-400 italic mt-1 block text-[10px]">(Edited)</span>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-12 text-gray-500">
            No reviews found matching your criteria.
            @if(request()->anyFilled(['search', 'type']))
                <br><a href="{{ route('home') }}" class="text-blue-600 hover:underline mt-2 inline-block">Clear Filters</a>
            @endif
        </div>
    @endforelse
</div>

<!-- Pagination Links -->
<div class="mt-8 mb-12">
    {{ $reviews->links('pagination::tailwind') }}
</div>
@endsection