<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'olla',
            'email' => 'febri@olla.com',
            'password' => Hash::make ('12345678'),
        ]);

        // Categoty dummy data
        Category::factory(2)->create();

        // Product dummy data
        Product::factory(5)->create();
    }
}
