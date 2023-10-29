<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;
use Google_Service_YouTube;

class YoutubeController extends Controller
{
    public function index()
    {
        return view('animes.movie');
    }
    
    public function search_videos(){
    //検索され、クエリパラメータ(URL末尾)が入っていたら下記を実行
    if (isset($_GET['q']) && isset($_GET['maxResults'])) {
        
        //APIキーを取得し、クライアントオブジェクト（クライアント側で実行されるメソッドなどが定義されている）を作成
        $DEVELOPER_KEY =  config("services.youtube.apikey");
        $client = new Google_Client();
        $client->setDeveloperKey($DEVELOPER_KEY);
        $youtube = new Google_Service_YouTube($client);
        
        //エラーが起きたら例外処理を実行
        try {
                //idにはビデオのID、snippetには動画の動画の基本的な情報（タイトル、説明、カテゴリなど）が格納される
                $searchResponse = $youtube->search->listSearch('id,snippet', array(
                  'q' => $_GET['q'],
                  'maxResults' => $_GET['maxResults'],
                ));

                //受け取るデータを格納する配列$videosを作成
                $videos = [];

                //$searchResponseのitemsに格納されたデータのtitleとvideoIdを$videosに格納する
                foreach ($searchResponse['items'] as $searchResult) {
                    array_push($videos, [$searchResult['snippet']['title'], $searchResult['id']['videoId']]);
                }
            } catch (\Google_Service_Exception $e) {
                    return $e->getMessage();
            } catch (\Google_Exception $e) {
                    return $e->getMessage();
            }
        return view('animes.movie')->with(["videos" => $videos, "count_videos" => count($videos), "search_word" => $_GET['q']]);
    }
}
}
