<?php
namespace App\Services;

class Profile extends Crudable {
    public function find(Type $var = null)
    {
        return $this->index(["posts", "postLikes.post"])->where(auth()->user()->profile->id);
    }
}