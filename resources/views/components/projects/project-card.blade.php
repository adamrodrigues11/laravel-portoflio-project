@props(['project', 'showBody' => false])

<div class="p-6  bg-white overflow-hidden shadow sm:rounded-lg">
    <div class="text-xl font-bold">
        <a href="/projects/{{ $project->slug }}">{{ $project->title }}</a>
    </div>
    @if (!$showBody)
        <div>{!! $project->excerpt !!}</div>
    @else
        <div>{!! $project->body !!}</div>
    @endif
    <footer>
        @if ($project->category)
        <a href="/categories/{{ $project->category->slug }}">Category: {{ $project->category->name }}</a>
        @endif
    </footer>
</div>