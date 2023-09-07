<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Cloudinary;
use App\Services\PostService;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit()]);
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
        $input = $request['post'];
        $image_path = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        $input += ['image_path' => $image_path]; 
        if (auth()->check()) {
            $input['user_id'] = auth()->user()->id;
        } else {
            return redirect('/register')->with('error', 'ログインしていないため投稿できません。');
        }
        $likedPosts = auth()->user()->likedPosts;
        $likeCount = $likedPosts->count();
        $input['like_count'] = $likeCount;
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function edit(Post $post)
    {
        return view('posts.edit')->with(['post' => $post]);
    }
    
    public function update(Request $request, Post $post)
    {
        // 投稿の更新に関する処理
    
        if ($request->hasFile('image_paths')) {
            foreach ($request->file('image_paths') as $image) {
                // 画像をアップロードし、Image モデルに関連付けて保存
                $imagePath = Cloudinary::upload($image->getRealPath())->getSecurePath();
                $post->images()->create(['image_path' => $imagePath]);
            }
        }
    
        return redirect('/posts/' . $post->id);
    }

  
}

