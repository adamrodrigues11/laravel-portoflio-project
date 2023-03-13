<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\TagSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ProjectSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProjectTagSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // populate categories and projects table with seed data
        $this->call([
            CategorySeeder::class,
            ProjectSeeder::class,
            TagSeeder::class,
            ProjectTagSeeder::class,
            UserSeeder::class,
        ]);
    }
}
