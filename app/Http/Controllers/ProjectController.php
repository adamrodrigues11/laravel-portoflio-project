<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('projects.index')
            ->with('projects', Project::all())
            ->with('category', null);
    }

    public function show(Project $project)
    {
        return view('projects.project', ['project' => $project]);
    }

    public function listByCategory(Category $category)
    {
        return view('projects.index')
            ->with('projects', $category->projects)
            ->with('category', $category);
    }

    public function create()
    {
        return view('admin.projects.create')
            ->with('categories', Category::all());
    }
    
    public function store()
    {
        $attributes = request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['nullable', 'sometimes', 'exists:categories,id'],
            'published_date' => ['nullable', 'sometimes', 'date'],
            'url' => ['required', 'sometimes', 'url'],
        ]);

        $attributes['slug'] = Str::slug($attributes['title']);

        Project::create($attributes);

        // Set a flash message
        session()->flash('success','Project Created Successfully');

        // Redirect to the Admin Dashboard
        return redirect('/admin');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', ['project' => $project]);
    }

    public function delete(Project $project)
    {
        // $project->delete();

        return redirect('/admin');
    }
}
