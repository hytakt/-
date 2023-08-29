<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefecture extends Model
{
    use HasFactory;
    
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
    
    public function animes()
    {
        return $this->belongsToMany(Anime::class);
    }
    
    protected $fillable = [
        'prefecture'
    ];
}
