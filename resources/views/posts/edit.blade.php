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
                {{ $post->image_path }}
                <div class="content_image">
                    <img src="{{ $post->image_path }}">
                    <input type="file" name="{{$post->image_path }}" value="{{ $post->image_path }}">
                </div>
                <input type='submit' value="保存">
            </form>
        </div>
    </body>
</html>
