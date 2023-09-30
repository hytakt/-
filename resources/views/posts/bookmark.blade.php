    <x-app-layout>
    <x-slot name="header">
        <h1 class="text-4xl font-semibold">ブックマークした記事</h1>
    </x-slot>

    <div class="px-4 py-2">
        <div class="space-y-4">
            @foreach($bookmarks as $bookmark)
                <div class="bg-white rounded-lg p-4 shadow-md">
                    <a href="/posts/{{ $bookmark->post_id }}" class="text-xl font-semibold text-indigo-600 hover:underline">{{ $bookmark->post->title }}</a>
                    <div class="text-gray-600 text-sm mt-1">
                        {{ $bookmark->post->created_at }}｜{{ $bookmark->user->name }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-4">
        <!-- <a href="/posts" class="text-indigo-500 hover:underline">戻る</a> -->
    </div>
</x-app-layout>

