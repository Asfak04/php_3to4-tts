<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $categories = [
            ['name' => 'Dairy, Bread & Eggs', 'image' => 'user/images/Slice-2_10.avif'],
            ['name' => 'Snacks & Munchies', 'image' => 'user/images/Slice-3_9.avif'],
            ['name' => 'Hookah', 'image' => 'user/images/Slice-4_9.avif'],
            ['name' => 'Mouth fresheners', 'image' => 'user/images/Slice-5_4.avif'],
            ['name' => 'Soft Drinks', 'image' => 'user/images/Slice-6_5.avif'],
            ['name' => 'Paan Corner', 'image' => 'user/images/Slice-7-1_0.avif'],
            ['name' => 'Hygiene & Care', 'image' => 'user/images/Slice-8_4.avif'],
            ['name' => 'Pet Care', 'image' => 'user/images/Slice-3_9.avif'], 
            ['name' => 'Baby Care', 'image' => 'user/images/Slice-10.avif'],
            ['name' => 'Coffee & Tea', 'image' => 'user/images/Slice-11.avif'],
        ];

        foreach ($categories as $catData) {
            $category = \App\Models\Category::create($catData);

            // Add 6 products per category
            for ($i = 1; $i <= 6; $i++) {
                \App\Models\Product::create([
                    'category_id' => $category->id,
                    'name' => 'Sample Product ' . $i . ' in ' . $catData['name'],
                    'description' => 'This is a sample description for product ' . $i,
                    'price' => rand(20, 500),
                    'image' => 'user/images/product' . rand(1, 24) . '.avif',
                    'unit' => rand(100, 1000) . ' ml/g',
                    'delivery_time' => rand(8, 20) . ' mins',
                    'stock_quantity' => rand(10, 100),
                ]);
            }
        }
    }
}
