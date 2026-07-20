<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Admin\ComboController;
use Illuminate\Support\Facades\Route;

// ---- Public site ----
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products/{product:slug}', [ProductPageController::class, 'show'])->name('product.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/{variant}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{category}', [ShopController::class, 'category'])->name('shop.category');
Route::get('/combos/{combo:slug}', [ComboController::class, 'show'])->name('combos.show');

Route::get('/fix-slugs-now', function () {
    $products = \App\Models\Product::all();
    $log = [];

    foreach ($products as $product) {
        $before = $product->slug;

        $base = \Illuminate\Support\Str::slug($product->name_en);
        if (empty($base)) {
            $base = 'product-' . $product->id;
        }

        $slug = $base;
        $i = 2;
        while (\App\Models\Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
            $slug = $base . '-' . $i++;
        }

        $product->slug = $slug;
        $product->saveQuietly();

        $log[] = "#{$product->id} {$product->name_en}: '{$before}' -> '{$product->slug}'";
    }

    return '<pre>'.implode("\n", $log).'</pre>';
});

// ---- Admin auth ----
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->name('login.attempt');
    });

    Route::middleware('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        Route::redirect('/', '/admin/categories');

        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::resource('products', ProductController::class)->except(['show']);
        Route::resource('combos', ComboController::class);

        Route::get('reviews', [ReviewController::class, 'index'])->name('reviews.index');
        Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');
        Route::post('reviews/{review}/toggle', [ReviewController::class, 'toggle'])->name('reviews.toggle');
        Route::delete('reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    });
});