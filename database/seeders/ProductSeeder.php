<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Sách 1',
            'price' => 150000,
            'stock' => 20,
            'description' => 'Mô tả sách 1',
            'image' => 'path_to_image1.jpg',
        ]);

        Product::create([
            'name' => 'Sách 2',
            'price' => 250000,
            'stock' => 15,
            'description' => 'Mô tả sách 2',
            'image' => 'path_to_image2.jpg',
        ]);

        Product::create([
            'name' => 'Sách 3',
            'price' => 300000,
            'stock' => 5,
            'description' => 'Mô tả sách 3',
            'image' => 'path_to_image3.jpg',
        ]);

        Product::create([
            'name' => 'Sách 4',
            'price' => 170000,
            'stock' => 12,
            'description' => 'Mô tả sách 4',
            'image' => 'path_to_image4.jpg',
        ]);

        Product::create([
            'name' => 'Sách 5',
            'price' => 200000,
            'stock' => 8,
            'description' => 'Mô tả sách 5',
            'image' => 'path_to_image5.jpg',
        ]);

        Product::create([
            'name' => 'Sách 6',
            'price' => 180000,
            'stock' => 25,
            'description' => 'Mô tả sách 6',
            'image' => 'path_to_image6.jpg',
        ]);

        Product::create([
            'name' => 'Sách 7',
            'price' => 220000,
            'stock' => 10,
            'description' => 'Mô tả sách 7',
            'image' => 'path_to_image7.jpg',
        ]);

        Product::create([
            'name' => 'Sách 8',
            'price' => 130000,
            'stock' => 30,
            'description' => 'Mô tả sách 8',
            'image' => 'path_to_image8.jpg',
        ]);

        Product::create([
            'name' => 'Sách 9',
            'price' => 190000,
            'stock' => 18,
            'description' => 'Mô tả sách 9',
            'image' => 'path_to_image9.jpg',
        ]);

        Product::create([
            'name' => 'Sách 10',
            'price' => 160000,
            'stock' => 22,
            'description' => 'Mô tả sách 10',
            'image' => 'path_to_image10.jpg',
        ]);
    }
}