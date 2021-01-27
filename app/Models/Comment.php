<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $with = ["author", "likes"];

    public function likes()
    {
        return $this->hasMany(CommentLike::class);
    }

    public function author()
    {
        return $this->belongsTo(Profile::class, "profile_id");
    }

    public function post()
    {
        return $this->belongsTo(Post::class, "post_id");
    }
}
