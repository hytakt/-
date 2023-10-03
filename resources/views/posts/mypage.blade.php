<x-app-layout>
    <x-slot name="header">
        <h1 class="text-4xl font-semibold">マイページ</h1>
    </x-slot>

    <div class="px-4 py-2">
        <nav class="space-x-4">
            <a class="px-2 py-1 rounded {{ Request::is('bookmarks') ? 'bg-indigo-500 text-white' : 'bg-green-200 text-green-800 hover:bg-green-400' }}" href="/bookmarks">ブックマーク</a>
        </nav>

        <div class="mt-4">
            <div class="flex flex-wrap -mx-4">
                @foreach($posts as $post)
                <div class="w-1/2 px-4 mb-4">
                    <div class="bg-white rounded-lg p-4 shadow-md">
                        <a class="block text-lg text-indigo-600 hover:underline" href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                        <div class="mt-2">
                            <img src="{{ $post->images[0]->image_path }}" alt="{{ $post->title }}" class="w-full h-52 object-cover rounded-lg shadow-md">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="mt-4">
            <a class="px-2 py-1 rounded bg-indigo-500 text-white hover:bg-indigo-600" href="/posts/create">投稿作成</a>
        </div>
    </div>
</x-app-layout>

