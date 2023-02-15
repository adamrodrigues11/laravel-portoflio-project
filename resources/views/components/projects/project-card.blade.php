<div class="p-6  bg-white overflow-hidden shadow sm:rounded-lg">
    <div class="text-xl font-bold">
        <a href="/projects/{{ $project->id }}">{{ $project->title }}</a>
    </div>
    <div>{{ $project->excerpt }}</div>
    <div>{{ $project->body }}</div>
</div>