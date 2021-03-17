<?php

namespace App\Http\Livewire;

use App\Services\Post as PostService;

class Posts extends ParentComponent
{
    public $posts;
    protected $post_service;
    public $profile;
    public $newPostText;

    public function mount(PostService $post_service): void
    {
        $this->post_service = $post_service;
        $this->posts = $post_service->index(["author", "likes", "comments"])->sortByDesc("created_at")->unique('id')->values();
        $this->profile = auth()->user()->profile ?? "User is not logged in";
    }

    public function createPost(PostService $post_service): string
    {
        if (strlen($this->newPostText) > 2) {
            $post_service->create([
                "profile_id" => auth()->id(),
                "text" => $this->newPostText,
            ]);
            // emit event pro refresh postů
            $this->emitSelf("post-change");
            return "Successfuly created new post.";
        }
        return "Text has to be at least 3 characters long.";
    }

    public function render()
    {
        return view('livewire.posts')->extends('template.layout')->section('content');
    }
}
