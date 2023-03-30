<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'product_category_id' => 1,
            'id' => 1000000000001,
            'product_name' => 'Makanan',
            'product_stock' => 100,
            'product_price' => 500000,
            'product_desc' => 'Makanan',
            'product_slug' => 'Makanan',
            'product_exp' => '2023-03-14',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}