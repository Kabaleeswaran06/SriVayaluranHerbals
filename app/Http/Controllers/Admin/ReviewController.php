<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::latest()->get();

        return view('admin.reviews.index', compact('reviews'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:150'],
            'role' => ['nullable', 'string', 'max:150'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'review_text' => ['required', 'string'],
        ]);
        $data['featured'] = false;

        Review::create($data);

        return redirect()->route('admin.reviews.index')->with('success', 'Review added. Toggle it on to show on the homepage.');
    }

    public function toggle(Review $review)
    {
        $review->update(['featured' => ! $review->featured]);

        return redirect()->route('admin.reviews.index');
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->route('admin.reviews.index')->with('success', 'Review deleted.');
    }
}
