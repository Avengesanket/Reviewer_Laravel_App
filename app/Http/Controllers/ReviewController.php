<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function publicIndex(Request $request)
    {
        $query = Review::where('is_public', true)->with('user');

        $this->applyFilters($query, $request);
        $reviews = $query->paginate(6)->withQueryString();
        
        return view('home', compact('reviews'));
    }

    public function privateIndex(Request $request)
    {
        $query = Auth::user()->reviews();

        $this->applyFilters($query, $request);

        $reviews = $query->paginate(6)->withQueryString();
        
        return view('dashboard', compact('reviews'));
    }

    private function applyFilters($query, $request)
    {
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('body', 'like', "%{$search}%")
                  ->orWhere('genre', 'like', "%{$search}%");
            });
        }

        if ($request->filled('type') && $request->type !== 'All') {
            $query->where('type', $request->type);
        }

        if ($request->has('sort')) {
            if ($request->sort == 'rating_desc') {
                $query->orderBy('rating', 'desc');
            } elseif ($request->sort == 'date_desc') {
                $query->orderBy('consumed_at', 'desc');
            }
        } else {
            $query->latest();
        }
    }

    public function create()
    {
        return view('reviews.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:50',
            'type' => 'required|in:Movie,Book,Game',
            'rating' => 'required|integer|min:1|max:10',
            'body' => 'required|max:150',
            'consumed_at' => 'required|date',
            'genre' => 'nullable|string|max:50',
        ]);

        $validated['is_public'] = $request->has('is_public');
        $request->user()->reviews()->create($validated);
        return redirect()->intended('dashboard')->with('success', 'Review added!');
    }

    public function edit(Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403);
        }
        return view('reviews.edit', compact('review'));
    }
    public function update(Request $request, Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|max:50',
            'type' => 'required|in:Movie,Book,Game',
            'rating' => 'required|integer|min:1|max:10',
            'body' => 'required|max:150',
            'consumed_at' => 'required|date',
            'genre' => 'nullable|string',
        ]);

        $validated['is_public'] = $request->has('is_public');

        $review->update($validated);

        return redirect()->intended('dashboard')->with('success', 'Review updated!');
    }

    public function destroy(Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403);
        }
        
        $review->delete();
        return redirect()->intended('dashboard')->with('success', 'Review deleted.');
    }

}
