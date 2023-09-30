<x-app-layout>
    <x-slot name="header">
        <h1 class="text-4xl font-semibold">投稿作成画面</h1>
    </x-slot>

    <div class="px-4 py-2">
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-lg font-medium text-gray-700">タイトル</label>
                <input type="text" id="title" name="post[title]" class="mt-2 px-3 py-2 w-full border rounded-lg shadow-sm focus:outline-none focus:ring focus:border-indigo-500" placeholder="タイトル" required>
            </div>

            <div class="mb-4">
                <label for="body" class="block text-lg font-medium text-gray-700">投稿の説明</label>
                <textarea id="body" name="post[body]" class="mt-2 px-3 py-2 w-full border rounded-lg shadow-sm focus:outline-none focus:ring focus:border-indigo-500" placeholder="投稿の説明の追加" required></textarea>
            </div>

            <div class="mb-4">
                <label for="images" class="block text-lg font-medium text-gray-700">画像のアップロード</label>
                <input type="file" id="images" name="images[]" multiple class="mt-2" required>
            </div>

            <div class="mb-4">
                <label for="prefecture" class="block text-lg font-medium text-gray-700">都道府県を選択！</label>
                <select id="prefecture" name="prefectures[]" multiple class="mt-2 w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring focus:border-indigo-500" required>
                    @foreach($prefectures as $pref)
                        <option value="{{ $pref->id }}">{{ $pref->prefecture }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-8">
                <button type="submit" class="px-6 py-3 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600">投稿</button>
            </div>
        </form>

        <div class="mt-4">
            <a href="/posts" class="text-indigo-500 hover:underline">戻る</a>
        </div>
    </div>
</x-app-layout>


