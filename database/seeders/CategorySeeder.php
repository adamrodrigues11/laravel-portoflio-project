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
        Category::create([
            'slug' => 'back-end',
            'name' => 'Back End',
        ]);
        Category::create([
            'slug' => 'front-end',
            'name' => 'Front End',
        ]);
        Category::create([
            'slug' => 'full-stack',
            'name' => 'Full Stack',
        ]);
    }
}
