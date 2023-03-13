<x-layout>
    <x-slot name="content">
        @if ($category || $tag)
            <header>
                <a href="/projects">&larr; Back to Projects</a>
                <h2 class="text-3xl font-bold">{{ $category?->name ?? $tag->name }} Projects</h2>
            </header>
        @endif
        <div
        class="flex flex-col align-items-center justify-centersm:items-center py-4 sm:pt-0">
            <div class="mt-6">
                <section class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    @foreach ($projects as $project)
                        <x-projects.project-card :project="$project" :showCategoryAndTags="true"/>
                    @endforeach
                </section>
                @if (count($projects))
                <div class="text-xs mt-4 w-full text-right">
                    @if($projects instanceof \Illuminate\Pagination\AbstractPaginator)
                        {{ $projects->links() }}
                    @else
                        Found {{ count($projects) }} {{ $category?->name ?? $tag?->name }} projects 
                    @endif
                </div>
                @else
                    <div>Nothing to showcase, yet.</div>
                @endif
            </div>
        </div>
    </x-slot>
</x-layout>