<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'body',
        'image_path',
        'like_count',
        'user_id',
    ];
    
    public function bookmark()
    {
        return $this->belongsTo(Bookmark::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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
    
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    
    
    public function getPaginateByLimit(int $limit_count = 10)
    {
        return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
}
