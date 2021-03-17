<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function destroy()
    {
        return Comment::destroy(request("comment_id"));
    }

    public function store()
    {
        return Comment::create([
            "profile_id" => Auth::id(),
            "post_id" => request("post_id"),
            "text" => request("text"),
        ]);
    }
}
