<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Food', 'color' => '#28a745'],
            ['name' => 'Transport', 'color' => '#007bff'],
            ['name' => 'Shopping', 'color' => '#ffc107'],
            ['name' => 'Others', 'color' => '#6c757d'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
