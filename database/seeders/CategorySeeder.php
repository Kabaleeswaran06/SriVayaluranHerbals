<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Tamil names left blank intentionally — fill in real translations
        // through the admin panel rather than guessed placeholders.
        foreach ([
            'Herbal Oils',
            'Churna & Powders',
            'Tonics',
            'Skin & Hair',
        ] as $name) {
            Category::firstOrCreate(['name_en' => $name]);
        }
    }
}
