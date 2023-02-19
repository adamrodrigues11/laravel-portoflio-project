<x-layout>
    <x-slot name="content">
        @if ($category)
            <header>
                <a href="/projects">&larr; Back to Projects</a>
                <h2 class="text-3xl font-bold">{{ $category->name }} Projects</h2>
            </header>
        @endif
        <div
        class="flex flex-col align-items-center justify-centersm:items-center py-4 sm:pt-0">
            <div class="mt-6">
                <section class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    @foreach ($projects as $project)
                        <x-projects.project-card :project="$project"/>
                    @endforeach
                </section>
                @if (count($projects))
                <div class="text-xs w-full text-right">{{ count($projects) }} projects to peep.</div>
                @else
                <div>Nothing to showcase, yet.</div>
                @endif
            </div>
        </div>
    </x-slot>
</x-layout>