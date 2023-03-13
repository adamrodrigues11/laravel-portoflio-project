<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('projects.index')
            ->with('projects', Project::latest('published_date')->paginate(6)->withQueryString())
            ->with('category', null)
            ->with('tag', null);
    }

    public function show(Project $project)
    {
        return view('projects.project', ['project' => $project]);
    }

    public function listByCategory(Category $category)
    {
        return view('projects.index')
            ->with('projects', $category->projects)
            ->with('category', $category)
            ->with('tag', null);
    }

    public function listByTag(Tag $tag)
    {
        return view('projects.index')
            ->with('projects', $tag->projects)
            ->with('category', null)
            ->with('tag', $tag);
    }

    public function create()
    {
        return view('admin.projects.form')
            ->with('project', null)
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }
    
    public function store()
    {
        $request = request();
        $attributes = $request->validate([
            'title' => ['required', 'unique:projects,title'],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['nullable', 'sometimes', 'exists:categories,id'],
            'published_date' => ['nullable', 'sometimes', 'date'],
            'url' => ['required', 'sometimes', 'url'],
            'image' => ['nullable','sometimes','image','mimes:jpg,png,jpeg,gif,svg','max:2048','dimensions:max_width=1200'],
            'thumb' => ['nullable','sometimes','image','mimes:jpg,png,jpeg,gif,svg','max:1024','dimensions:max_width=600'],
        ]);
        
        // Save the uploaded image files into public storage
        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->storeAs('images',$request->image->getClientOriginalName(), 'public');
            $attributes['image'] = $image_path;
        }
        if ($request->hasFile('thumb')) {
            $thumb_path = $request->file('thumb')->storeAs('images', $request->thumb->getClientOriginalName(), 'public');
            $attributes['thumb'] = $thumb_path;
        }

        $attributes['slug'] = Str::slug($attributes['title']);

        $project = Project::create($attributes);

        // Add tags to the project
        if ($request->has('tags')) {
            $project->tags()->attach($request->tags);
        }

        // Set a flash message
        session()->flash('success','Project Created Successfully');

        // Redirect to the Admin Dashboard
        return redirect('/admin');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.form')
            ->with('project', $project)
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }

    public function update(Project $project, Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required','unique:projects,title,'.$project->id],
            'excerpt' => 'required',
            'body' => 'required',
            'url' => ['nullable','sometimes','url'],
            'published_date' => ['nullable','sometimes','date'],
            'category_id' => ['nullable','sometimes','exists:categories,id'],
            'image' => ['nullable','sometimes','image','mimes:jpg,png,jpeg,gif,svg','max:2048','dimensions:max_width=1200'],
            'thumb' => ['nullable','sometimes','image','mimes:jpg,png,jpeg,gif,svg','max:1024','dimensions:max_width=600'],
        ]);

        // Save the uploaded image files into public storage
        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->storeAs('images',$request->image->getClientOriginalName(), 'public');
            $attributes['image'] = $image_path;
        }
        if ($request->hasFile('thumb')) {
            $thumb_path = $request->file('thumb')->storeAs('images', $request->thumb->getClientOriginalName(), 'public');
            $attributes['thumb'] = $thumb_path;
        }
        
        $attributes['slug'] = Str::slug($attributes['title']);

        $project->update($attributes);

        // Update project tags
        $project->tags()->sync($request->tags ?? []);

        // Set a flash message
        session()->flash('success','Project Updated Successfully');

        // Redirect to the Admin Dashboard
        return redirect('/admin');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        // Set a flash message
        session()->flash('success','Project Deleted Successfully');

        // Redirect to the Admin Dashboard
        return redirect('/admin');
    }

    // JSON API
    public function getProjectsJSON()
    {
        $projects = Project::with(['category', 'tags'])->get();
        return response()->json($projects);
    }
}
