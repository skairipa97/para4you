<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Sample Product',
            'description' => 'This is a sample product description.',
            'price' => 29.99,
            'image' => 'path/to/sample-image.jpg'
        ]);
    }
}

