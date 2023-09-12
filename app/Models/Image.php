<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    
    protected $fillable = [
        'post_id',
        'image_path'
    ];
}
