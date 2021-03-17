<?php

namespace App\Models;
class Post extends LikeableModel
{
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
