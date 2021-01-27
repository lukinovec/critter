<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function followers()
    {
        return $this->hasMany(Follower::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function postLikes()
    {
        return $this->hasMany(PostLike::class);
    }
    public function commentLikes()
    {
        return $this->hasMany(CommentLike::class);
    }
}
