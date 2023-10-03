<x-app-layout>
    <x-slot name="header">
        <h1 class="text-4xl font-semibold">あにつう！</h1>
    </x-slot>
    <div class="m-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
            @foreach ($posts as $post)
                <div class="bg-white p-4 shadow-md">
                    <h2 class="text-4xl font-semibold">
                        <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                    </h2>
                    <div class="mt-2">
                        <h3 class="text-gray-600">{{ $post->user->name }}</h3>
                    </div>
                    <div class="mt-4 relative rounded overflow-hidden shadow-md">
                        <img src="{{ $post->images[0]->image_path }}" class="w-full">
                    </div>
                    @if ($post->prefecture_id !== 0)
                        <div class="mt-2">
                            @foreach ($post->prefectures as $prefecture)
                                <a href="/prefecture/{{$prefecture->id}}" class="text-gray-400">
                                    <i class="fas fa-map-marker-alt mr-1"></i>{{ $prefecture->prefecture }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                    <div class="mt-4 flex items-center">
                        @auth
                            @if (!$post->isLikedBy(Auth::user()))
                            <span class="likes">
                                <div class="cursor-pointer">
                                    <i class="fas fa-heart like-toggle" data-post-id="{{ $post->id }}"></i>
                                    <span class="ml-1 like-counter">{{ $post->likes_count }}</span>
                            </span>
                                </div>
                            @else
                                <div class="cursor-pointer text-red-600">
                                    <i class="fas fa-heart heart like-toggle liked" data-post-id="{{ $post->id }}"></i>
                                    <span class="ml-1 like-counter">{{ $post->likes_count }}</span>
                                </div>
                            @endif
                        @endauth
                        <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-600 py-2 px-3 rounded-md text-white ml-2" type="button" onclick="deletePost({{ $post->id }})">
                                削除
                            </button>
                        </form>
                    </div>
                    <article class="mt-4">
                        @if (!Auth::user()->is_bookmark($post->id))
                            <form action="{{ route('bookmark.store', $post) }}" method="post">
                                @csrf
                                <button class="bg-yellow-400 py-2 px-3">お気に入り登録</button>
                            </form>
                        @else
                            <form action="{{ route('bookmark.destroy', $post) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="text-red-600">お気に入り解除</button>
                            </form>
                        @endif
                    </article>
                    <div class="mt-4 text-gray-600">
                        {{ $post->created_at }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="mt-8">
        {{ $posts->links() }}
    </div>
    <script>
            function deletePost(id) {
                'use strict'
        
                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
</x-app-layout>
