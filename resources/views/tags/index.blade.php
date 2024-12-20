<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Tags</h1>
    </x-slot>

    <div class="container mx-auto p-6">
        <a href="{{ route('tags.create') }}" class="bg-gray-800 dark:bg-blue-600 hover:bg-blue-700 
        text-gray-800 dark:text-white  px-4 py-2 rounded-md mb-4 inline-block">Buat Tags Baru</a>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="w-full table-auto text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Nama Tag</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                        <tr class="border-b">
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $tag->name }}</td>
                            <td class="px-4 py-2 d-flex">
                                <a href="{{ route('tags.edit', $tag) }}" 
                                class="bg-yellow-500 text-gray-200 px-3 py-1 rounded-md hover:bg-yellow-600 text-sm">
                                    Edit
                                </a>
                                <form action="{{ route('tags.destroy', $tag) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-gray-200 px-3 py-1 
                                    rounded-md hover:bg-red-600 text-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
