<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>
    <body>
        <h1 class='title'>編集画面</h1>
        <div class='content'>
            <form action="/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="content_title">
                    <h2>タイトル</h2>
                    <input type='text' name="post[title]" value="{{ $post->title }}">
                </div>
                <div class="content_body">
                    <h2>本文</h2>
                    <input type='text' name="post[body]" value="{{ $post->body }}">
                </div>
                <div class="content_image">
                    @foreach($post->images as $image)
                        <img src="{{ $image->image_path }}">
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="image_path">新しい画像</label>
                    <input type="file" name="new_image[]" id="new_image_path" multiple>
                </div>

                <button type="submit" class="btn btn-primary">更新</button>
                <a href="/posts/{{ $post->id }}">戻る</a>
            
            </form>
        </div>
    </body>
</html>
