<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $featuredProject = Project::where('isFeatured', true)->first();
        $recentProjects = Project::where('isFeatured', false)->orderBy('published_date', 'desc')->take(3)->get();
        return view('index')
            ->with('featuredProject', $featuredProject)
            ->with('recentProjects', $recentProjects);
    }
}
