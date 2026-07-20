<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Creates the shop's admin login. Username/password come from .env
     * (ADMIN_USERNAME / ADMIN_PASSWORD) so they're easy to change without
     * touching code — they default to admin / admin@123 as requested.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => env('ADMIN_USERNAME', 'admin')],
            [
                'name' => 'Shop Admin',
                'email' => 'admin@srivayaluranherbals.example',
                'password' => Hash::make(env('ADMIN_PASSWORD', 'admin@123')),
            ]
        );
    }
}
