<x-layout>
    <x-slot name="content">
        <div class="justify-self-start">
            <a href="/projects">&larr; Back to Projects</a>
        </div>
        <x-projects.project-card :project="$project" :showBody="true"/>
    </x-slot>
</x-layout>