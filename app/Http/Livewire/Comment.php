<?php

namespace App\Http\Livewire;

class Comment extends LikeableComponent
{
    public function mount(\App\Models\Comment $comment)
    {
        $this->item = $comment;
    }

    public function render()
    {
        return view('livewire.comment', [
            "comment" => $this->item
        ]);
    }
}
