@props(['project', 'showBody' => false, 'showFullImg' => false, 'showCategoryAndTags' => false])

<div class="p-6  bg-white overflow-hidden shadow sm:rounded-lg">
    <div class="text-xl font-bold">
        <a href="/projects/{{ $project->slug }}">{{ $project->title }}</a>
    </div>
    @if(!$showFullImg)
    <div class="flex flex-row py-4">
        {{-- thumbnail --}}
        <img src="{{url("storage/" . ($project->thumb ?? "images/download.jpeg"))}}" alt="placeholder image" class="rounded shadow-md w-20 mx-4">
    @else
    <div class="flex flex-col gap-4 items-center py-4">
        {{-- full image --}}
        <img src="{{url("storage/" . ($project->image ?? "images/download.jpeg"))}}" alt="placeholder image" class="rounded shadow-md w-4/12">
    @endif
        @if (!$showBody)
            <div>{!! $project->excerpt !!}</div>
        @else
            <div>{!! $project->body !!}</div>
        @endif
    </div>
    @if($showCategoryAndTags)
    <footer>
        @if ($project->category)
        <a href="/projects/categories/{{ $project->category->slug }}">Category: {{ $project->category->name }}</a>
        @endif
        <br>
        @if (count($project->tags) > 0)
            Tags:
            @foreach ($project->tags as $tag)
                <a href="/projects/tags/{{ $tag->slug }}">{{ $tag->name }}</a>
            @endforeach
        @endif
    </footer>
    @endif
</div>