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
