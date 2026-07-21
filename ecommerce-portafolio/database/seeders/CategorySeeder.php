<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Muebles', 'Electrónica', 'Ropa', 'Hogar'];

        foreach ($categories as $name) {
            Category::create([
                'name' => $name,
                'slug' => \Illuminate\Support\Str::slug($name),
            ]);
        }
    }
}
