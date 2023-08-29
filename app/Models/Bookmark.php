<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    
    protected $fillable = [
        'user_id',
        'post_id'
    ];
}
