<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-800">Artikel Saya</h1>
    </x-slot>

    <div class="container mx-auto p-6">
        <a href="{{ route('articles.create') }}" class="bg-gray-800 dark:bg-blue-600 hover:bg-blue-700 text-gray-800 dark:text-white  px-4 py-2 rounded-md mb-4 inline-block">Buat Artikel Baru</a>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="w-full table-auto text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Judul</th>
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Kategori</th>
                        <th class="w-50 px-4 py-2 text-sm font-medium text-gray-600">Konten</th>
                        @can('edit articles|delete articles')
                        <th class="px-4 py-2 text-sm font-medium text-gray-600">Aksi</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                        <tr class="border-b">
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $article->title }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $article->category->name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ Str::limit($article->content, 50) }}</td>
                            @can('edit artciles|delete articles')
                            <td class="px-4 py-2 d-flex">
                                @can('edit articles')
                                <a href="{{ route('articles.edit', $article) }}" class="bg-yellow-500 text-gray-200 px-3 py-1 rounded-md hover:bg-yellow-600 text-sm">Edit</a>
                                @endcan
                                @can('delete articles')
                                <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-gray-200 px-3 py-1 rounded-md hover:bg-red-600 text-sm">Hapus</button>
                                </form>
                                @endcan
                                
                            </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
