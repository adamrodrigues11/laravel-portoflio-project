<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Explicitly attach tags to projects
        $portfolioProject = Project::find(1);
        $portfolioProject->tags()->attach([1,2,3]);
        
        $portfolioProject = Project::find(2);
        $portfolioProject->tags()->attach([2,3]);
        
        $portfolioProject = Project::find(3);
        $portfolioProject->tags()->attach([3, 5]);
        
        $portfolioProject = Project::find(4);
        $portfolioProject->tags()->attach([7]);

    }
}
