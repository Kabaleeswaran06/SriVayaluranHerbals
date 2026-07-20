<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /** Session-based cart — no accounts/checkout, just a working add/view/remove flow. */
    private const SESSION_KEY = 'cart';

    public function index(Request $request)
    {
        $cart = $this->hydrateCart($request);

        return view('cart', ['lines' => $cart['lines'], 'total' => $cart['total']]);
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'variant_id' => ['required', 'exists:product_variants,id'],
            'qty' => ['nullable', 'integer', 'min:1', 'max:20'],
        ]);

        $variant = ProductVariant::findOrFail($data['variant_id']);
        if ((int) $variant->product_id !== (int) $data['product_id']) {
            abort(422, 'That pack size does not belong to this product.');
        }

        $qty = $data['qty'] ?? 1;
        $cart = session(self::SESSION_KEY, []);
        $key = $data['variant_id'];

        $cart[$key] = ($cart[$key] ?? 0) + $qty;
        session([self::SESSION_KEY => $cart]);

        $count = array_sum($cart);

        if ($request->wantsJson()) {
            return response()->json(['count' => $count, 'message' => 'Added to cart.']);
        }

        return back()->with('success', 'Added to cart.');
    }

    public function remove(Request $request, ProductVariant $variant)
    {
        $cart = session(self::SESSION_KEY, []);
        unset($cart[$variant->id]);
        session([self::SESSION_KEY => $cart]);

        return back()->with('success', 'Removed from cart.');
    }

    /** Shared helper: turns the session's {variant_id: qty} map into display-ready lines + total. */
    public static function hydrateCart(Request $request): array
    {
        $cart = session(self::SESSION_KEY, []);
        if (empty($cart)) {
            return ['lines' => collect(), 'total' => 0];
        }

        $variants = ProductVariant::with('product')->whereIn('id', array_keys($cart))->get();

        $lines = $variants->map(function (ProductVariant $variant) use ($cart) {
            $qty = $cart[$variant->id] ?? 0;
            return (object) [
                'variant' => $variant,
                'product' => $variant->product,
                'qty' => $qty,
                'lineTotal' => $qty * $variant->price,
            ];
        })->filter(fn ($line) => $line->product !== null && $line->qty > 0)->values();

        return ['lines' => $lines, 'total' => $lines->sum('lineTotal')];
    }

    public static function count(): int
    {
        return array_sum(session(self::SESSION_KEY, []));
    }
}