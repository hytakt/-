<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Cloudinary;
use App\Services\PostService;
use App\Models\Image;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Prefecture;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Post $post)
    {
        $user = auth()->user();
        $posts = Post::query()
            ->with(['user', 'likes', 'comments','prefectures'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        
        return view('posts.index')->with(['posts' => $posts]);
    }
    
    public function show(Post $post)
    {
        return view('posts.show')->with(['post' => $post]);
    }
    
   public function create()
    {
        $prefecures = Prefecture::all();

        $user = Auth::user();

        $data = [
            'user' => $user
        ];

        return view('posts.create', $data)->with(['prefectures' => $prefecures]);  
    }
    
    public function comment(Request $request, Post $post)
    {
        // リクエストからコメントのデータを取得
        $input = $request->input('comments');
        $commentText = $input['comment'];
    
        // コメントが空でないことを検証
        if (!empty($commentText)) {
            // コメントが空でない場合、コメントを保存
            $comment = new Comment();
            $comment->comment = $commentText;
            $comment->user_id = $request->user()->id;
            $comment->post_id = $post->id;
            $comment->save();
        }
    
        return view('posts.show')->with(['post' => $post]);
    }
    
    public function mypageIndex()
    {
        $posts = \Auth::user()->posts()->orderBy('created_at', 'desc')->paginate(10);
        $data = [
            'posts' => $posts,
        ];
        return view('posts.mypage', $data);
    }

    public function store(Request $request, Post $post)
    {
        if (auth()->check()) {
            $input = $request['post'];
            $input += ['user_id' => $request->user()->id];
            
            $likeCount = auth()->user()->likedPosts->count();
            $input['like_count'] = $likeCount;
            
            
            $post->fill($input)->save();
            
            $post->prefectures()->attach($request->prefectures);
            
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
        
        return view('posts.edit')->with(['post' => $post]);
    }
    
    public function update(Request $request, Post $post)
    {
        if (auth()->check()) {
            $input = $request->only(['new_image_path']);
            $user = auth()->user();
            
            $images_delete = $request->input('imagesDelete');
            foreach ($images_delete as $delete){
                Image::where('id', $delete)->delete();
            }
            
            
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
        $user_id = Auth::user()->id; 
        $post_id = $request->post_id; 
    
        $already_liked = Like::where('user_id', $user_id)->where('post_id', $post_id)->first(); 
    
        if (!$already_liked) { 
            $like = new Like; 
            $like->post_id = $post_id;
            $like->user_id = $user_id;
            $like->save();
        } else {
            Like::where('post_id', $post_id)->where('user_id', $user_id)->delete();
        }
        $post_likes_count = Post::withCount('likes')->findOrFail($post_id)->likes_count;
        $param = [
            'post_likes_count' => $post_likes_count,
        ];
        return response()->json($param); 
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
    
    public function bookmark_posts()
    {
        $posts = \Auth::user()->bookmark_posts()->orderBy('created_at', 'desc')->paginate(10);
    
        return view('posts.bookmark', ['bookmarks' => $posts]);
    }
    
    public function searchIndex(Prefecture $prefecture)
    {
        $prefectures = $prefecture->get();
        
        
        return view('posts.search')->with(['prefectures' => $prefectures]);
    }
    
     public function search(Request $request, Prefecture $prefecture)
    {
        $input = $request->input('pref'); 
        
        $result_prefecture = Prefecture::find($request["pref"]);
        
        $prefectures = $prefecture->get();
        
        return view('posts.result')->with(['result' => $result_prefecture, 'prefectures' => $prefectures]);
    }
    
    public function prefecture($id)
    {
        $only_pref = Prefecture::find($id);
        
        return view('prefectures.result')->with(['only_pref' => $only_pref]);
    }
    
    public function map()
    {
        return view('posts.map');
    }
}
