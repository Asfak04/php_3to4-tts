<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class DummyProductSeeder extends Seeder
{
    public function run()
    {
        // 1. Create Categories
        $categories = [
            ['name' => 'Fresh Fruits', 'image' => 'user/images/Slice-10.avif'],
            ['name' => 'Vegetables', 'image' => 'user/images/Slice-11.avif'],
            ['name' => 'Dairy & Bakery', 'image' => 'user/images/Slice-12.avif'],
            ['name' => 'Snacks & Munchies', 'image' => 'user/images/Slice-13.avif'],
            ['name' => 'Beverages', 'image' => 'user/images/Slice-14.avif'],
            ['name' => 'Baby Care', 'image' => 'user/images/babycare-WEB.avif'],
            ['name' => 'Pet Care', 'image' => 'user/images/Pet-Care_WEB.avif'],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['name' => $cat['name']], $cat);
        }

        // 2. Add Products
        $fruitsId = Category::where('name', 'Fresh Fruits')->first()->id;
        $vegId = Category::where('name', 'Vegetables')->first()->id;
        $dairyId = Category::where('name', 'Dairy & Bakery')->first()->id;
        $snacksId = Category::where('name', 'Snacks & Munchies')->first()->id;

        $products = [
            // Fruits
            ['category_id' => $fruitsId, 'name' => 'Shimla Apple', 'price' => 120, 'unit' => '1 kg', 'image' => 'user/images/product1.avif', 'delivery_time' => '10 mins'],
            ['category_id' => $fruitsId, 'name' => 'Banana Robust', 'price' => 60, 'unit' => '6 pcs', 'image' => 'user/images/product2.avif', 'delivery_time' => '8 mins'],
            ['category_id' => $fruitsId, 'name' => 'Organic Orange', 'price' => 150, 'unit' => '1 kg', 'image' => 'user/images/product3.avif', 'delivery_time' => '12 mins'],
            ['category_id' => $fruitsId, 'name' => 'Green Grapes', 'price' => 90, 'unit' => '500 g', 'image' => 'user/images/product4.avif', 'delivery_time' => '15 mins'],
            
            // Vegetables
            ['category_id' => $vegId, 'name' => 'Fresh Tomato', 'price' => 45, 'unit' => '1 kg', 'image' => 'user/images/product5.avif', 'delivery_time' => '7 mins'],
            ['category_id' => $vegId, 'name' => 'Hybrid Onion', 'price' => 38, 'unit' => '1 kg', 'image' => 'user/images/product6.avif', 'delivery_time' => '9 mins'],
            ['category_id' => $vegId, 'name' => 'Potato Agra', 'price' => 30, 'unit' => '2 kg', 'image' => 'user/images/product7.avif', 'delivery_time' => '11 mins'],
            
            // Dairy
            ['category_id' => $dairyId, 'name' => 'Standard Milk', 'price' => 66, 'unit' => '1 L', 'image' => 'user/images/product8.avif', 'delivery_time' => '5 mins'],
            ['category_id' => $dairyId, 'name' => 'Salted Butter', 'price' => 255, 'unit' => '500 g', 'image' => 'user/images/product9.avif', 'delivery_time' => '8 mins'],
            ['category_id' => $dairyId, 'name' => 'Paneer Cubes', 'price' => 110, 'unit' => '200 g', 'image' => 'user/images/product10.avif', 'delivery_time' => '10 mins'],

            // Snacks
            ['category_id' => $snacksId, 'name' => 'Classic Salted Chips', 'price' => 20, 'unit' => '50 g', 'image' => 'user/images/product11.avif', 'delivery_time' => '10 mins'],
            ['category_id' => $snacksId, 'name' => 'Chocolate Cookies', 'price' => 40, 'unit' => '100 g', 'image' => 'user/images/product12.avif', 'delivery_time' => '12 mins'],
            ['category_id' => $snacksId, 'name' => 'Mixed Nuts', 'price' => 350, 'unit' => '250 g', 'image' => 'user/images/product13.avif', 'delivery_time' => '15 mins'],
            ['category_id' => $snacksId, 'name' => 'Roasted Peanut', 'price' => 99, 'unit' => '200 g', 'image' => 'user/images/product14.avif', 'delivery_time' => '10 mins'],
            
            // More randoms
            ['category_id' => $fruitsId, 'name' => 'Watermelon', 'price' => 80, 'unit' => '1 pc', 'image' => 'user/images/product15.avif', 'delivery_time' => '15 mins'],
            ['category_id' => $fruitsId, 'name' => 'Pomegranate', 'price' => 200, 'unit' => '1 kg', 'image' => 'user/images/product16.avif', 'delivery_time' => '11 mins'],
            ['category_id' => $vegId, 'name' => 'Green Peas', 'price' => 70, 'unit' => '500 g', 'image' => 'user/images/product17.avif', 'delivery_time' => '10 mins'],
            ['category_id' => $vegId, 'name' => 'Cauliflower', 'price' => 40, 'unit' => '500 g', 'image' => 'user/images/product18.avif', 'delivery_time' => '12 mins'],
            ['category_id' => $dairyId, 'name' => 'Curd Cup', 'price' => 30, 'unit' => '200 g', 'image' => 'user/images/product19.avif', 'delivery_time' => '8 mins'],
            ['category_id' => $snacksId, 'name' => 'Corn Flakes', 'price' => 180, 'unit' => '500 g', 'image' => 'user/images/product20.avif', 'delivery_time' => '10 mins'],
        ];

        foreach ($products as $prod) {
            Product::updateOrCreate(['name' => $prod['name']], $prod);
        }
    }
}

