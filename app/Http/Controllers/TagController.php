<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function create() {
        return view('admin.tags.form')
            ->with('tag', null);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ['required', 'unique:tags,name']        
        ]);

        Tag::create([
            'name' => $request->name,
            'slug' => $request->name,
        ]);

        session()->flash('success', 'Tag created successfully.');

        return redirect('/admin');
    }

    public function edit(tag $tag) {
        return view('admin.tags.form')
            ->with('tag', $tag);
    }

    public function update(Request $request, Tag $tag) {
        $request->validate([
            'name' => ['required', 'unique:tags,name,'.$tag->id]        
        ]);

        $tag->update([
            'name' => $request->name,
            'slug' => $request->name,
        ]);

        session()->flash('success', 'Tag updated successfully.');

        return redirect('/admin');
    }

    public function destroy(Tag $tag) {
        $tag->delete();

        session()->flash('success', 'Tag deleted successfully.');

        return redirect('/admin');
    }

    public function getTagsJSON() {
        $tags = Tag::all();
        return response()->json($tags);
    }
}
