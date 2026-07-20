<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductPageController extends Controller
{
    public function show(Product $product)
    {
        $product->load(['variants', 'category']);

        $related = Product::with(['variants', 'category'])
            ->where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->orderBy('sort_order')
            ->limit(8)
            ->get();

        if ($related->count() < 4) {
            $more = Product::with(['variants', 'category'])
                ->where('id', '!=', $product->id)
                ->whereNotIn('id', $related->pluck('id'))
                ->orderBy('sort_order')
                ->limit(8 - $related->count())
                ->get();
            $related = $related->concat($more);
        }

        return view('product-show', compact('product', 'related'));
    }
}