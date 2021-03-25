<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Like;

class Profile extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $with = ["posts", "likes"];

    public function followers()
    {
        return Like::where([
            "parent" => "profile",
            "parent_id" => $this->id
        ])->get();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
