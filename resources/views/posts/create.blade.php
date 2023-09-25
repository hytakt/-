    <x-app-layout>
        <h1>投稿作成画面</h1>
        <form action="/posts" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="post[title]" placeholder="タイトル"/>
            </div>
            <div class="body">
                <h2>Body</h2>
                <textarea name="post[body]" placeholder="投稿の説明の追加"></textarea>
            </div>
            <div class="image">
                <input type="file" name="images[]" multiple>
            </div>
            <input type="submit" value="投稿"/>
        </form>
        <div class="footer">
            <a href="/posts">戻る</a>
        </div>
    </x-app-layout>
</html>
