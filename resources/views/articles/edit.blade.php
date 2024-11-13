<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-800">Edit Artikel</h1>
    </x-slot>

    <div class="max-w-3xl mx-auto p-6">
        <form action="{{ route('articles.update',$article) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <x-input-label for="title" class="block text-sm font-medium text-gray-700">Judul</x-input-label>
                <input type="text" id="title" name="title" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required value="{{old('title') ?? $article->title}}">
            </div>

            <div class="mb-4">
                <x-input-label for="category" class="block text-sm font-medium text-gray-700">Category</x-input-label>
                <select name="category_id" id="category" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">- Pilih -</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            

            <div class="mb-4">
                <x-input-label for="content" class="block text-sm font-medium text-gray-700">Konten</x-input-label>
                <textarea id="content" name="content" rows="5" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>{{old('content') ?? $article->content}}</textarea>
            </div>
            

            <x-primary-button type="submit">Edit</x-primary-button>
        </form>
    </div>
</x-app-layout>
