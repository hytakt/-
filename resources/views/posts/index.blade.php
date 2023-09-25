<x-app-layout>
    <div class="m-8 p-8 w-48 bg-gray-100 shadow-lg">
        <h1 class=" font-bold text-5xl border-b-4 sm:text-2xl md:text-4xl">あにつう</h1>
    </div>
    <div class='posts'>
        @foreach ($posts as $post)
            <div class='post'>
                <div>
                    <h2 class="username">{{ $post->user->name }}</h2>
                </div>
                <h2 class='title'>
                    <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                </h2>
                <p class='body'>{{ $post->body }}</p>
                <div class="grid gap-2 row-gap-2 lg:grid-cols-2">
                @foreach($post->images as $image)
                <div class="relative rounded overflow-hidden shadow-md">
                    <img src="{{ $image->image_path }}" class="w-full">
                </div>
                @endforeach
                </div>
            </div>
            @auth
            <!-- Post.phpに作ったisLikedByメソッドをここで使用 -->
            @if (!$post->isLikedBy(Auth::user()))
                <span class="likes">
                    <div class="cursor-pointer">
                        <i class="fas fa-heart like-toggle" data-post-id="{{ $post->id }}"></i>
                <span class="like-counter">{{$post->likes_count}}</span>
                </span><!-- /.likes -->
                </div>
            @else
                <span class="likes">
                    <dev class="cursor-pointer color-red-600">
                        <i class="fas fa-heart heart like-toggle liked" data-post-id="{{ $post->id }}"></i>
                <span class="like-counter">{{$post->likes_count}}</span>
                </span><!-- /.likes -->
                </div>
            @endif
            @endauth
            <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                @csrf
                @method('DELETE')
                <button type="button" onclick="deletePost({{ $post->id }})">削除</button>
            </form>
            <article class="post-item">
                <div class="post-info">
                    {{ $post->created_at }}
                </div>
                <div class="post-control">
                    @if (!Auth::user()->is_bookmark($post->id))
                    <form action="{{ route('bookmark.store', $post) }}" method="post">
                        @csrf
                        <button>お気に入り登録</button>
                    </form>
                    @else
                    <form action="{{ route('bookmark.destroy', $post) }}" method="post">
                        @csrf
                        @method('delete')
                        <button>お気に入り解除</button>
                    </form>
                    @endif
                </div>
            </article>
        @endforeach
    </div>
    <div class='paginate'>
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
