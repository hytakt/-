<x-app-layout>
    <x-slot name="header">
        <h1 class="text-4xl font-semibold">YouTubeで聖地巡礼！</h1>
    </x-slot>
    <form action="/youtube/search" method="GET" class="mt-4 p-4">
        <div class="mb-4">
            <label for="q" class="text-xl">検索キーワード：</label>
            <input type="search" id="q" name="q" placeholder="検索キーワードを入力" class="border rounded-md p-2">
        </div>
        <div class="mb-4">
            <label for="maxResults" class="text-xl">最大結果数：</label>
            <input type="number" id="maxResults" name="maxResults" min="1" max="50" step="1" value="25" class="border rounded-md p-2">
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
            検索
        </button>
    </form>
    @isset($videos)
        <div class="m-8 text-2xl">検索結果</div>
        <div class="mt-4 space-y-4"> <!-- 検索結果の余白を追加 -->
            <div class="flex flex-wrap -m-4">
                @for ($i = 0; $i < $count_videos; $i++)
                    <div class="w-1/2 p-4"> <!-- 画面幅の半分に設定 -->
                        <a href="https://www.youtube.com/watch?v={{ $videos[$i][1] }}" class="text-blue-500 hover:underline">
                            {{ $i + 1 }} {{ $videos[$i][0] }}
                        </a>
                        <iframe
                            src="https://www.youtube.com/embed/{{ $videos[$i][1] }}"
                            title="YouTubeビデオプレイヤー"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen
                            class="h-64"
                        ></iframe>
                    </div>
                @endfor
            </div>
        </div>
    @endisset
</x-app-layout>
