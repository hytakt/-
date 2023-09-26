    <x-app-layout>
        <h1 class="title">
            {{ $post->title }}
        </h1>
        <div class="content">
            <div class="content__post">
                <h2>投稿の説明</h2>
                <p>{{ $post->body }}</p>    
            </div>
            <div>
                @foreach($post->images as $image)
                    <img src="{{ $image->image_path }}" alt="画像が読み込めません。"/>
                @endforeach
            </div>
            <form action="{{ route('comment', ['post' => $post->id]) }}" method="POST">
                @csrf
                <div class="create_comment">
                    <textarea name="comments[comment]" placeholder="コメント入力"></textarea>
                </div>
                <input type="submit" value="コメント送信">
            </form>
            <div>
                <h3>【コメント一覧】</h3>
                @foreach($post->comments as $comment)
                    <p>{{ $comment->comment }}</p>
                @endforeach
            </div>
        </div>
        <div class="edit"><a href="/posts/{{ $post->id }}/edit">編集</a></div>
        <div class="footer">
            <a href="/posts">戻る</a>
        </div>
    </x-app-layout>
