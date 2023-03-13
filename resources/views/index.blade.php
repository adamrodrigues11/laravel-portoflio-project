<x-layout>
    <x-slot name="content">
        <h1 class="text-center">Adam Rodrigues - Web Developer</h1>
        <x-projects.project-card :project="$featuredProject" :showFullImg="true"/>
        @foreach ($recentProjects as $project)
            <x-projects.project-card :project="$project"/>
        @endforeach
        <button><a href="/projects">View All Projects</a></button>
    </x-slot>
</x-layout>