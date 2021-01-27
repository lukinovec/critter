<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        return Post::with("author", "likes", "comments")->get()->sortByDesc("created_at")->unique('id')->values();
    }

    public function destroy()
    {
        return Post::destroy(request("post_id"));
    }

    public function store()
    {
        return Post::create([
            "profile_id" => Auth::id(),
            "text" => request("crit"),
        ]);
    }
}
