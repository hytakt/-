<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function bookmark()
    {
        return $this->belongsTo(Bookmark::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function like()
    {
        return $this->belongsTo(Like::class);
    }
    
    public function animes()
    {
        return $this->belongsToMany(Anime::class);
    }
    
    public function prefectures()
    {
        return $this->belongsToMany(Prefecture::class);
    }
    
    protected $fillable = [
        'title',
        'body',
        'image_path',
        'like_count',
        'user_id'
    ];
}
