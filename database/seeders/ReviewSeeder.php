<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $reviews = [
            [
                'customer_name' => 'Radhika Subramaniam',
                'role' => 'Customer since 1994',
                'rating' => 5,
                'review_text' => 'My grandmother bought her hair oil here. Now I buy it for my daughter. Nothing about the smell or the result has changed in thirty years.',
                'featured' => true,
            ],
            [
                'customer_name' => 'Muthu Kannan',
                'role' => 'Regular Customer',
                'rating' => 5,
                'review_text' => 'I have tried other Ayurvedic brands, but the Chyawanprash from Sri Vayaluran actually tastes and works like the one my father used to bring home.',
                'featured' => true,
            ],
            [
                'customer_name' => 'Priya Elango',
                'role' => 'Customer since 2016',
                'rating' => 5,
                'review_text' => 'What I trust most is that they will tell you honestly if a product is not right for your problem, instead of just selling you something.',
                'featured' => true,
            ],
            [
                'customer_name' => 'Suresh Babu',
                'role' => 'New Customer',
                'rating' => 4,
                'review_text' => 'Good quality products, staff explained the right oil for my scalp issue. Will visit again.',
                'featured' => false,
            ],
        ];

        foreach ($reviews as $review) {
            Review::firstOrCreate(['customer_name' => $review['customer_name']], $review);
        }
    }
}
