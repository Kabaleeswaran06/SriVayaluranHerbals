<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComboItem extends Model
{
    protected $table = 'combo_product';

    protected $fillable = [
        'combo_id', 'product_id', 'custom_name', 'custom_name_ta', 'grams', 'sort_order',
    ];

    public function combo()
    {
        return $this->belongsTo(Combo::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Display name, whether it's a real product or a manually typed item
    public function getNameEnAttribute(): string
    {
        return $this->custom_name ?: optional($this->product)->name_en ?? '';
    }

    public function getNameTaAttribute(): ?string
    {
        return $this->custom_name_ta ?: optional($this->product)->name_ta;
    }
}
