<x-layout>
    <x-slot name="content">
        <div class="flex flex-col items-center justify-center gap-y-5 py-4">
            <h2 class="uppercase">Admin</h2>    
            <x-admin.admin-card model="project" :data="$projects"/>
            <x-admin.admin-card model="user" :data="$users"/>
        </div>
    </x-slot>
</x-layout>