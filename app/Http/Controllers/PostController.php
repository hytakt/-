<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Cloudinary;
use App\Services\PostService;
use App\Models\Image;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Post $post)
    {
        $user = auth()->user();
    $posts = Post::withCount('likes')->orderByDesc('updated_at')->get();
    return view('posts.index', ['posts' => $posts])->with(['posts' => $post->getPaginateByLimit()]);
        // return view('posts.index')->with(['posts' => $post->getPaginateByLimit()]);
    }
    
    public function show(Post $post)
    {
        return view('posts.show')->with(['post' => $post]);
    }
    
   public function create()
    {
        return view('posts.create');  
    }

    public function store(Request $request, Post $post)
    {
        if (auth()->check()) {
            $input = $request['post'];
            $input += ['user_id' => $request->user()->id];
            
            $likeCount = auth()->user()->likedPosts->count();
            $input['like_count'] = $likeCount;
            
            $post->fill($input)->save();
            
            foreach ($request->file('images') as $upload_image){
                $image_path = Cloudinary::upload($upload_image->getRealPath())->getSecurePath();
                $image = new Image();
                $image->image_path = $image_path;
                $image->post_id = $post->id;
                $image->save();
            }
            
            
        } else {
            return redirect('/login')->with('error', 'ログインしていないため投稿できません。');
        }
    
        return redirect('/posts/' . $post->id);
    }
    
    public function edit(Request $request, Post $post)
    {
        $images_delete = $request->input('imagesDelete', []);
        foreach ($images_delete as $delete){
            Image::where('image_path', $delete)->delete();
    }
        return view('posts.edit')->with(['post' => $post]);
    }
    
    public function update(Request $request, Post $post)
    {
        if (auth()->check()) {
            $input = $request->only(['new_image_path']);
            $user = auth()->user();
            
            $input['user_id'] = $user->id;
            
            $post->fill($input)->save();
            
            if($request->hasFile('new_image')){
                foreach($request->file('new_image') as $upload_new_image){
                    $new_image_path = Cloudinary::upload($upload_new_image->getRealPath())->getSecurePath();
                    $new_image = new Image();
                    $new_image->image_path = $new_image_path;
                    $new_image->post_id = $post->id;
                    $new_image->save();
                }
            }
            
        } else {
            return redirect('/login')->with('error', 'ログインしていないため投稿できません。');
        }
    
        $post->fill($input)->save();
        
        return redirect('/posts/' . $post->id);
    }
    
    public function like(Request $request)
    {
        $user_id = Auth::user()->id; // ログインしているユーザーのidを取得
        $post_id = $request->post_id; // 投稿のidを取得
    
        // すでにいいねがされているか判定するためにlikesテーブルから1件取得
        $already_liked = Like::where('user_id', $user_id)->where('post_id', $post_id)->first(); 
    
        if (!$already_liked) { 
            $like = new Like; // Likeクラスのインスタンスを作成
            $like->post_id = $post_id;
            $like->user_id = $user_id;
            $like->save();
        } else {
            // 既にいいねしてたらdelete 
            Like::where('post_id', $post_id)->where('user_id', $user_id)->delete();
        }
        // 投稿のいいね数を取得
        $post_likes_count = Post::withCount('likes')->findOrFail($post_id)->likes_count;
        $param = [
            'post_likes_count' => $post_likes_count,
        ];
        return response()->json($param); // JSONデータをjQueryに返す
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/posts');
    }
    
    public function bookmark_posts()
    {
        $posts = \Auth::user()->bookmark_posts()->orderBy('created_at', 'desc')->paginate(10);
        $data = [
            'posts' => $posts,
        ];
        return view('posts.bookmarks', $data);
    }
}

