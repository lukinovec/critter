<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use App\Services\Post as PostService;
use Illuminate\Support\Facades\Storage;

class Posts extends ParentComponent
{
    use WithFileUploads;
    public $posts;
    protected $post_service;
    public $profile;
    public $image_name;
    // protected $image;
    public $newPostText;

    protected $listeners = ["upload-image" => "saveImage", "post-change" => "mount"];

    public function mount(PostService $post_service): void
    {
        $this->post_service = $post_service;
        $this->posts = $post_service->index(["author", "likes", "comments"])->sortByDesc("created_at")->unique('id')->values();
        $this->profile = auth()->user()->profile ?? "User is not logged in";
    }

    public function saveImage($image)
    {
        $image = str_replace('data:image/jpeg;base64,', '', $image);
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $this->image_name = "user_uploads/" . ((string) time()) . ".jpg";
        Storage::put($this->image_name, base64_decode($image));
    }

    public function createPost(PostService $post_service): string
    {
        if (strlen($this->newPostText) > 2) {
            $post_service->create([
                "profile_id" => auth()->id(),
                "text" => $this->newPostText,
                "image" => $this->image_name ?? ""
            ]);
            // emit event pro refresh postů
            $this->newPostText = "";
            $this->emitSelf("post-change");
            return "Successfuly created new post.";
        }
        return "Text has to be at least 3 characters long.";
    }

    public function testAlert()
    {
        $this->dispatchBrowserEvent("swal:test");
    }

    public function render()
    {
        return view('livewire.posts')->extends('template.layout')->section('content');
    }
}
