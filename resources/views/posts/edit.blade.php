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
                    <img src="{{ $post->images()->image_path }}">
                </div>
                <div class="form-group">
                    <label for="image_path">新しい画像</label>
                    <input type="file" name="new_image_path" id="new_image_path">
                </div>

                <button type="submit" class="btn btn-primary">更新</button>
            
            </form>
        </div>
    </body>
</html>
