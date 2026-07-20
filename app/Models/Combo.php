<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Combo extends Model
{
    protected $fillable = [
        'title', 'title_ta', 'slug', 'banner_image', 'main_image',
        'price', 'description', 'additional_info', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // All items in this combo — both real products and manually-typed items (e.g. "Roja Poo")
    public function items(): HasMany
    {
        return $this->hasMany(ComboItem::class)->orderBy('sort_order');
    }
}
