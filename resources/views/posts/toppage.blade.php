<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
           @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <title>Posts</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
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
</html>
