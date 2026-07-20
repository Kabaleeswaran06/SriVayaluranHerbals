<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_ta',
        'image',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /** Public accessor for a browser-ready image URL, or null if none uploaded. */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/'.$this->image) : null;
    }
}
