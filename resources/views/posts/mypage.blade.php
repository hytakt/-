    <x-app-layout>
    <body>
        <h1 class="page-heading">マイページ</h1>
        <a class="tab-item{{ Request::is('bookmarks') ? ' active' : ''}}" href="/bookmark">ブックマーク</a>
        <div class="mypage">
            <div class="mypage_post">
                @foreach($posts as $post)
                    <li><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></li>
                @endforeach
            </div>
        </div>
        <div class="footer">
            <a href="/posts/create">投稿作成</a>
        </div>
    </body>
    </x-app-layout>

