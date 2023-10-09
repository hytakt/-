<x-app-layout>
    <x-slot name="header">
        <h1 class="text-4xl font-semibold">{{ $post->title }}</h1>
    </x-slot>

    <div class="px-4 py-2">
        <div class="space-y-4">
            <div class="content">
                <div class="content__post">
                    <h2 class="text-lg font-semibold">投稿の説明</h2>
                    <p>{{ $post->body }}</p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    @foreach($post->images as $image)
                        <img src="{{ $image->image_path }}" alt="画像が読み込めません。" class="w-full rounded-lg shadow-md">
                    @endforeach
                </div>
                <form action="{{ route('comment', ['post' => $post->id]) }}" method="POST">
                    @csrf
                    <div class="mt-4">
                        <textarea name="comments[comment]" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:border-indigo-500" placeholder="コメント入力"></textarea>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="px-4 py-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600">コメント送信</button>
                    </div>
                </form>
                <div class="mt-4">
                    <h3 class="text-lg font-semibold mt-4">コメント一覧</h3>
                    <ul class="bg-gray-100 p-4 rounded-lg">
                        @foreach($post->comments as $key => $comment)
                            <li class="{{ $key % 2 === 0 ? 'bg-white' : 'bg-gray-200' }} p-2 rounded-lg mb-2">
                                {{ $comment->comment }}
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="mt-4">
        <div class="edit"><a href="/posts/{{ $post->id }}/edit" class="text-indigo-500 hover:underline">編集</a></div>
        <div class="footer">
            <a href="/" class="text-indigo-500 hover:underline">戻る</a>
        </div>
    </div>
</x-app-layout>
