<x-app-layout>
    <x-slot name="header">
        <h1 class="text-4xl font-semibold">編集画面</h1>
    </x-slot>

    <div class="px-4 py-2">
        <form action="/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-lg font-medium text-gray-700">タイトル</label>
                <input type="text" id="title" name="post[title]" value="{{ $post->title }}" class="mt-2 px-3 py-2 w-full border rounded-lg shadow-sm focus:outline-none focus:ring focus:border-indigo-500" required>
            </div>

            <div class="mb-4">
                <label for="body" class="block text-lg font-medium text-gray-700">本文</label>
                <textarea id="body" name="post[body]" class="mt-2 px-3 py-2 w-full border rounded-lg shadow-sm focus:outline-none focus:ring focus:border-indigo-500" required>{{ $post->body }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-lg font-medium text-gray-700">画像</label>
                <div class="flex flex-wrap -mx-2">
                    @foreach($post->images as $image)
                        <div class="w-1/3 px-2 mb-4">
                            <img id="form_{{ $image->id }}" src="{{ $image->image_path }}" alt="Image" class="w-full rounded-lg shadow-md">
                            <label for="imageDelete" class="block mt-2 text-indigo-600 cursor-pointer hover:underline" onclick="deleteImage({{ $image->id }})">削除</label>
                            <input type="checkbox" name="imagesDelete[]" id="imageDelete_{{ $image->id }}" value="{{ $image->id }}" class="hidden">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mb-4">
                <label for="new_image_path" class="block text-lg font-medium text-gray-700">新しい画像</label>
                <input type="file" name="new_image[]" id="new_image_path" multiple class="mt-2">
            </div>

            <div class="mt-8">
                <button type="submit" class="px-6 py-3 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600">更新</button>
                <a href="/posts/{{ $post->id }}" class="ml-4 text-indigo-500 hover:underline">戻る</a>
            </div>
        </form>
    </div>

    <script>
        function deleteImage(id) {
            var previewImage = document.getElementById(`form_${id}`);
            var deleteCheckbox = document.getElementById(`imageDelete_${id}`);

            if (previewImage && deleteCheckbox) {
                previewImage.src = "";
                deleteCheckbox.checked = true;
            }
        }
    </script>
</x-app-layout>
