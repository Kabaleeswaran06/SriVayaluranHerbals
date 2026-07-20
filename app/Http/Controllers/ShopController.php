<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class ShopController extends Controller
{
    /**
     * "All Products" page — shows every category as a browsable tile.
     * Route: GET /shop  -> shop.index
     */
    public function index(): View
    {
        $categories = Category::withCount('products')
            ->orderBy('name_en')
            ->get();

        return view('shop.index', compact('categories'));
    }

    /**
     * Single category page — shows every product inside that category.
     * Route: GET /shop/{category} -> shop.category
     *
     * Uses implicit route-model binding by id. If you later add a
     * `slug` column to categories, change the route to
     * {category:slug} and this method needs no changes.
     */
    public function category(Category $category): View
    {
        $products = $category->products()
            ->with('variants')
            ->orderBy('sort_order')
            ->orderBy('name_en')
            ->get();

        return view('shop.category', compact('category', 'products'));
    }
}
