<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\App;
use App\Services\Comment as CommentService;

class Post extends LikeableComponent
{
    public string $comment_text = "";

    public function mount(\App\Models\Post $post)
    {
        $this->item = $post;
    }

    public function comment(CommentService $comment)
    {
        $comment->create([
            "profile_id" => auth()->id(),
            "post_id" => $this->item->id,
            "text" => $this->comment_text
        ]);
        $this->emit("post-change");
    }

    public function render()
    {
        return view('livewire.post', ["item" => $this->item]);
    }
}
