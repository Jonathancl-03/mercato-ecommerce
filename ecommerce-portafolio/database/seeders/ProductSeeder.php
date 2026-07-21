<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Silla de madera', 'category' => 'Muebles', 'price' => 150.00],
            ['name' => 'Mesa de centro', 'category' => 'Muebles', 'price' => 320.00],
            ['name' => 'Audífonos Bluetooth', 'category' => 'Electrónica', 'price' => 89.90],
            ['name' => 'Smartwatch', 'category' => 'Electrónica', 'price' => 199.00],
            ['name' => 'Polo básico', 'category' => 'Ropa', 'price' => 39.90],
            ['name' => 'Lámpara de escritorio', 'category' => 'Hogar', 'price' => 65.00],
        ];

        foreach ($products as $item) {
            $category = Category::where('name', $item['category'])->first();

            Product::create([
                'category_id' => $category->id,
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'description' => 'Descripción de ' . $item['name'],
                'price' => $item['price'],
                'stock' => rand(5, 50),
                'image' => 'https://via.placeholder.com/300x300?text=' . urlencode($item['name']),
            ]);
        }
    }
}
