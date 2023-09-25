<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\Bookmark;

class BookmarkController extends Controller
{
    public function bookmarkIndex(){
        $posts = \Auth::user()->posts()->orderBy('created_at', 'desc')->paginate(10);
        $data = [
            'posts' => $posts,
        ];
        $bookmarks = Bookmark::where('user_id', auth()->user()->id)->paginate(10);
        return view('posts.bookmark', $data, ['bookmarks' => $bookmarks]);
    }
    public function store($postId) {
        $user = \Auth::user();
        if (!$user->is_bookmark($postId)) {
            $user->bookmark_posts()->attach($postId);
        }
        return back();
    }
    public function destroy($postId) {
        $user = \Auth::user();
        if ($user->is_bookmark($postId)) {
            $user->bookmark_posts()->detach($postId);
        }
        return back();
    }
}
