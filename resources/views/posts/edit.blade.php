<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>
    <body>
        <h1 class='title'>編集画面</h1>
        <div class='content'>
            <form action="/posts/{{ $post->id }}" method="POST">
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
                <div class="form-group">
                    <label for="image_paths">新しい画像</label>
                    <input type="file" name="image_paths[]" id="image_paths" multiple>
                </div>
                <input type='submit' value="保存">
            </form>
        </div>
    </body>
</html>
