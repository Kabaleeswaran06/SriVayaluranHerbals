<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Combo;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ComboController extends Controller
{
    public function index()
    {
        $combos = Combo::withCount('items')->orderBy('sort_order')->paginate(15);
        return view('admin.combos.index', compact('combos'));
    }

    public function create()
    {
        $products = Product::orderBy('name_en')->get();
        return view('admin.combos.form', ['combo' => new Combo(), 'products' => $products]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = Str::slug($data['title']) . '-' . uniqid();

        if ($request->hasFile('banner_image')) {
            $data['banner_image'] = $request->file('banner_image')->store('combos', 'public');
        }
        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')->store('combos', 'public');
        }

        $combo = Combo::create($data);

        $this->syncItems($combo, $request);

        return redirect()->route('admin.combos.index')->with('success', 'Combo pack created.');
    }

    public function edit(Combo $combo)
    {
        $products = Product::orderBy('name_en')->get();
        $combo->load('items.product');
        return view('admin.combos.form', compact('combo', 'products'));
    }

    public function update(Request $request, Combo $combo)
    {
        $data = $this->validated($request, $combo->id);

        if ($request->hasFile('banner_image')) {
            if ($combo->banner_image) Storage::disk('public')->delete($combo->banner_image);
            $data['banner_image'] = $request->file('banner_image')->store('combos', 'public');
        }
        if ($request->hasFile('main_image')) {
            if ($combo->main_image) Storage::disk('public')->delete($combo->main_image);
            $data['main_image'] = $request->file('main_image')->store('combos', 'public');
        }

        $combo->update($data);

        $this->syncItems($combo, $request);

        return redirect()->route('admin.combos.index')->with('success', 'Combo pack updated.');
    }

    public function destroy(Combo $combo)
    {
        if ($combo->banner_image) Storage::disk('public')->delete($combo->banner_image);
        if ($combo->main_image) Storage::disk('public')->delete($combo->main_image);
        $combo->delete(); // items cascade-deleted via FK

        return back()->with('success', 'Combo pack deleted.');
    }

    private function validated(Request $request, $comboId = null): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'title_ta' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'additional_info' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
            'banner_image' => 'nullable|image|max:4096',
            'main_image' => 'nullable|image|max:4096',

            'product_id' => 'array',
            'product_id.*' => 'nullable|exists:products,id',
            'custom_name' => 'array',
            'custom_name.*' => 'nullable|string|max:255',
            'custom_name_ta' => 'array',
            'custom_name_ta.*' => 'nullable|string|max:255',
            'grams' => 'array',
            'grams.*' => 'required|numeric|min:0',
        ]);
    }

    /**
     * Rebuild combo items from the submitted rows. Each row is either:
     *  - a real product (product_id set), or
     *  - a manual/custom item (product_id blank, custom_name filled — e.g. "Roja Poo")
     * A row needs at least one of product_id or custom_name to be kept.
     */
    private function syncItems(Combo $combo, Request $request): void
    {
        $productIds     = $request->input('product_id', []);
        $customNames    = $request->input('custom_name', []);
        $customNamesTa  = $request->input('custom_name_ta', []);
        $grams          = $request->input('grams', []);

        $combo->items()->delete();

        foreach ($grams as $i => $gramValue) {
            $productId  = $productIds[$i] ?? null;
            $customName = $customNames[$i] ?? null;

            // Skip rows with neither a selected product nor a typed name
            if (!$productId && !$customName) {
                continue;
            }

            $combo->items()->create([
                'product_id'     => $productId ?: null,
                'custom_name'    => $productId ? null : $customName,
                'custom_name_ta' => $productId ? null : ($customNamesTa[$i] ?? null),
                'grams'          => $gramValue,
                'sort_order'     => $i,
            ]);
        }
    }
}
