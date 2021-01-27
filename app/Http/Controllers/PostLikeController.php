<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\PostLike;

class PostLikeController extends Controller
{
    public function index()
    {
        return Auth::user()->profile->postLikes;
    }

    public function store()
    {
        return PostLike::create([
            "profile_id" => Auth::id(),
            "post_id" => request("post_id")
        ]);
    }

    public function destroy()
    {
        return PostLike::where("post_id", request("post_id"))->where("profile_id", Auth::user()->profile->id)->first()->delete();
    }
}
