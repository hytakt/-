<x-app-layout>
    <x-slot name="header">
        <h1 class="text-4xl font-semibold">YouTubeで聖地巡礼！</h1>
    </x-slot>
    <form action="/youtube/search" method="GET">
        <div>
            Search Term: <input type="search" id="q" name="q" placeholder="Enter Search Term">
        </div>
        <div>
            Max Results: <input type="number" id="maxResults" name="maxResults" min="1" max="50" step="1" value="25">
        </div>
        <input type="submit" value="Search">
    </form>
    @isset($videos)
        <div>検索結果</div>
            @for ($i = 0; $i < $count_videos; $i++)
                    <div>
                        <a href="https://www.youtube.com/watch?v={{$videos[$i][1]}}" >{{$i +1}} {{$videos[$i][0]}}</a>
                    </div>
                    <div>
                        <iframe src="https://www.youtube.com/embed/{{$videos[$i][1]}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
            @endfor
    @endisset
</x-app-layout>
