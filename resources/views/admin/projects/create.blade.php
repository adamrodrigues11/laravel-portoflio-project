<x-layout>
    <x-slot name="content">
      <main class="max-w-lg mx-auto">
        <h1 class="text-center font-bold text-xl mb-3">Create A New Project</h1>
        <form method="POST" action="/admin/projects/create">
          @csrf
          <div class="mb-6">
            <label for="title" class="block mb-2 uppercase font-bold text-xs text-gray-700">Title</label>
            <input type="text" name="title" id="title" value={{old('title')}} required class="border border-gray-400 rounded p2 w-full">
            @error('title')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div class="mb-6">
            <label for="excerpt" class="block mb-2 uppercase font-bold text-xs text-gray-700">Excerpt</label>
            <input type="text" name="excerpt" id="excerpt" value={{old('excerpt')}} required class="border border-gray-400 rounded p2 w-full">
            @error('excerpt')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div class="mb-6">
            <label for="body" class="block mb-2 uppercase font-bold text-xs text-gray-700">Body</label>
            <input type="text" name="body" id="body" required class="border border-gray-400 rounded p2 w-full">
            @error('body')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div class="mb-6">
            <label for="url" class="block mb-2 uppercase font-bold text-xs text-gray-700">URL</label>
            <input type="url" name="url" id="url" required class="border border-gray-400 rounded p2 w-full">
            @error('url')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div class="mb-6">
            <label for="published_date" class="block mb-2 uppercase font-bold text-xs text-gray-700">Date Published</label>
            <input type="date" name="published_date" id="published_date" required class="border border-gray-400 rounded p2 w-full">
            @error('published_date')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div class="mb-6">
            <label for="category_id" class="block mb-2 uppercase font-bold text-xs text-gray-700">Category</label>
            <select name="category_id" id="category_id" class="border border-gray-400 rounded p2 w-full">
            <option value="" selected disabled>Select a category</option>
            <option value"">None</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if ($category->id == old('category_id')) selected @endif>{{ $category->name }}</option>
            @endforeach
            </select>
            @error('category')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>
          <div class="mb-6">
            <button type="submit" class="bg-green-700 text-white rounded py-2 px-4 hover:bg-green-600">Submit</button>
          </div>
        </form>
      </main>
    </x-slot>
  </x-layout>