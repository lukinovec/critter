<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Helpers\Service;

class LikeableComponent extends Component {
    public $item;
    public $likes;
    public $did_user_like;

    protected function get_likeable() {
        return (new Service(get_called_class()))->likeable();
    }


    public function likes_count() {
        return $this->item->likes->count();
    }

    public function delete()
    {
        $this->get_likeable()->delete($this->item->id);
        $this->emit("post-change");
    }

    public function like()
    {
        if ($this->did_user_like) {
            $this->get_likeable()->unlike($this->item->id, auth()->id());
        } else {
            $this->get_likeable()->like($this->item->id);
        }
        $this->emit("post-change");
    }

    public function unlike()
    {
        $this->get_likeable()->unlike($this->item->id, auth()->id());
        $this->emit("post-change");
    }

    public function render_like_section()
    {
        return view("components.like-section", [
            "item" => $this->item
        ])->render();
    }
}