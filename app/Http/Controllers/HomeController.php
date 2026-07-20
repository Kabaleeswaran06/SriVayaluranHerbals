<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Review;

class HomeController extends Controller
{
    /** How many products to surface per category on the homepage. */
    private const PER_CATEGORY = 4;

    public function index()
    {
        $categories = Category::with(['products' => function ($query) {
            $query->orderBy('sort_order')->with('variants');
        }])->get()->map(function (Category $category) {
            $total = $category->products->count();
            $category->setRelation('products', $category->products->take(self::PER_CATEGORY));
            $category->total_products = $total;
            $category->showing_count = $category->products->count();
            return $category;
        })->filter(fn (Category $c) => $c->products->isNotEmpty())->values();

        $reviews = Review::where('featured', true)->latest()->get();
        $combos = \App\Models\Combo::where('is_active', true)->orderBy('sort_order')->get();

        return view('home', compact('categories', 'reviews','combos'));
    }
}
