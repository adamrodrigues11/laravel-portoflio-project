<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::create([
            'slug' => 'php',
            'name' => 'PHP',
        ]);
        Tag::create([
            'slug' => 'laravel',
            'name' => 'Laravel',
        ]);
        Tag::create([
            'slug' => 'node-js',
            'name' => 'Node.js',
        ]);
        Tag::create([
            'slug' => 'react',
            'name' => 'React',
        ]);
        Tag::create([
            'slug' => 'aws',
            'name' => 'AWS',
        ]);
        Tag::create([
            'slug' => 'c-sharp',
            'name' => 'C#',
        ]);
        Tag::create([
            'slug' => 'dotnet',
            'name' => '.NET',
        ]);
        Tag::create([
            'slug' => 'vue',
            'name' => 'Vue',
        ]);
        Tag::create([
            'slug' => 'angular',
            'name' => 'Angular',
        ]);
        Tag::create([
            'slug' => 'css',
            'name' => 'CSS',
        ]);
        Tag::create([
            'slug' => 'html5',
            'name' => 'HTML5',
        ]);
        Tag::create([
            'slug' => 'sass',
            'name' => 'SASS',
        ]);
        Tag::create([
            'slug' => 'javascript',
            'name' => 'JavaScript',
        ]);
    }
}
