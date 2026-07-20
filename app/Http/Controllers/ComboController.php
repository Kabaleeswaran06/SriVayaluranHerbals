<?php

namespace App\Http\Controllers;

use App\Models\Combo;

class ComboController extends Controller
{
    public function show(Combo $combo)
    {
        abort_unless($combo->is_active, 404);
        $combo->load('items.product');

        return view('combos.show', compact('combo'));
    }
}
