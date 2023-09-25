<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-app-layout>
    <body>
        @section('content')
        <h1 class="page-heading">ブックマークした記事</h1>
        <dev class="bookmarks">
            @foreach($bookmarks as $bookmark)
                <dl>
                    <dt><a href="/posts/{{ $bookmark->post_id }}">{{ $bookmark->post->title }}</a></dt>
                    <dd><div class="bookmark_post-info">{{ $bookmark->post->created_at }}｜{{ $bookmark->user->name }}</div></dd>
                </dl>
            @endforeach
        </dev>
        <div class="footer">
            <!--<a href="/posts">戻る</a>-->
        </div>
    </body>
    </x-app-layout>
</html>
