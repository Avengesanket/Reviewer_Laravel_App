@extends('layout')
@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Log a New Review</h2>
    
    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('reviews.update', $review) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block font-bold mb-1">Title</label>
            <input type="text" name="title" maxlength="50" value="{{ old('title', $review->title) }}" class="w-full border p-2 rounded">
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-bold mb-1">Type</label>
                <select name="type" class="w-full border p-2 rounded">
                    <option value="Movie">Movie</option>
                    <option value="Book">Book</option>
                    <option value="Game">Video Game</option>
                </select>
            </div>
            <div>
                <label class="block font-bold mb-1">Genre</label>
                <input type="text" name="genre" maxlength="50" value="{{ old('genre', $review->genre) }}" class="w-full border p-2 rounded">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block font-bold mb-1">Rating (1-10)</label>
                <input type="number" name="rating" min="1" max="10" value="{{ old('rating', $review->rating) }}" class="w-full border p-2 rounded">
            </div>
            <div>
                <label class="block font-bold mb-1">Date Consumed</label>
                <input type="date" name="consumed_at" value="{{ old('consumed_at', $review->consumed_at) }}" class="w-full border p-2 rounded">
            </div>
        </div>

        <div class="mb-4">
            <label class="block font-bold mb-1">Review</label>
            <textarea name="body" rows="4"  maxlength="150" class="w-full border p-2 rounded">{{ old('body', $review->body) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="inline-flex items-center">
                
                <input type="checkbox" name="is_public" value="1" class="form-checkbox" {{ old('is_public', $review->is_public) ? 'checked' : '' }}>
                <span class="ml-2">Make Public?</span>
            </label>
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Save Review</button>
    </form>
</div>
@endsection