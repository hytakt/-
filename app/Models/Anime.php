<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;
    
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
    
    public function prefectures()
    {
        return $this->belongsToMany(Prefecture::class);
    }
    
    protected $fillable = [
        'anime_name'
    ];
}
