<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name_en')->get();

        $products = Product::with(['category', 'variants'])
            ->when($request->filled('category'), fn ($q) => $q->where('category_id', $request->integer('category')))
            ->orderBy('sort_order')
            ->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name_en')->get();

        return view('admin.products.form', [
            'product' => new Product(),
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $variants = $this->variantsFromRequest($request);

        if (empty($variants)) {
            return back()->withInput()->withErrors(['var_value' => 'Add at least one pack size with a price.']);
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($data);
        $product->variants()->createMany($variants);

        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name_en')->get();
        $product->load('variants');

        return view('admin.products.form', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validated($request);
        $variants = $this->variantsFromRequest($request);

        if (empty($variants)) {
            return back()->withInput()->withErrors(['var_value' => 'Add at least one pack size with a price.']);
        }

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        // Simplest consistent approach: replace the variant set on every save.
        $product->variants()->delete();
        $product->variants()->createMany($variants);

        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete(); // variants cascade-delete via the FK

        return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name_en' => ['required', 'string', 'max:150'],
            'name_ta' => ['nullable', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'additional_details' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);
    }

    /** Zips the var_value[]/var_unit[]/var_price[] rows into variant arrays, skipping incomplete rows. */
    private function variantsFromRequest(Request $request): array
    {
        $values = $request->input('var_value', []);
        $units = $request->input('var_unit', []);
        $prices = $request->input('var_price', []);

        $variants = [];
        foreach ($values as $i => $value) {
            $value = trim((string) $value);
            $price = trim((string) ($prices[$i] ?? ''));
            if ($value !== '' && $price !== '') {
                $variants[] = [
                    'value' => $value,
                    'unit' => $units[$i] ?? 'gms',
                    'price' => $price,
                ];
            }
        }

        return $variants;
    }
}
