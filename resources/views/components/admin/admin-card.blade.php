@props(['model', 'data' => []])

<div class="flex flex-col justify-between gap-y-2 items-start p-6 bg-white overflow-hidden shadow rounded-lg w-10/12">
    <h3 class="text-xl font-bold capitalize">{{ $model }}s</h3>
    <button class="self-end bg-green-700 text-white rounded py-2 px-4 hover:bg-green-600"><a href="/admin/{{ $model }}s/create">Create {{ $model }}</a></button>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        @foreach ($data as $item)
            <tr class="odd:bg-slate-200 even:bg-white flex flex-row items-center justify-between">
                <td class="">{{ $item->title ?? $item->name }}</td>
                <td>
                    <button class="bg-green-700 text-white rounded py-2 px-4 hover:bg-green-600"><a href="/admin/{{ $model }}s/{{ $item->slug ?? $item->id }}/edit">Edit</a></button>
                    <button class="bg-red-700 text-white rounded py-2 px-4 hover:bg-red-600"><a href="/admin/{{ $model }}s/{{ $item->slug ?? $item->id }}/delete">Delete</a></button>
                </td>
            </tr>
        @endforeach
    </table>
</div>