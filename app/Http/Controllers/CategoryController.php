<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create() {
        return view('admin.categories.form')
            ->with('category', null);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ['required', 'unique:categories,name']        
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => $request->name,
        ]);

        session()->flash('success', 'Category created successfully.');

        return redirect('/admin');
    }

    public function edit(Category $category) {
        return view('admin.categories.form')
            ->with('category', $category);
    }

    public function update(Request $request, Category $category) {
        $request->validate([
            'name' => ['required', 'unique:categories,name,'.$category->id]        
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => $request->name,
        ]);

        session()->flash('success', 'Category updated successfully.');

        return redirect('/admin');
    }

    public function destroy(Category $category) {
        $category->delete();

        session()->flash('success', 'Category deleted successfully.');

        return redirect('/admin');
    }

    public function getCategoriesJSON() {
        $categories = Category::all();
        return response()->json($categories);
    }
}
