<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Helpers\Service;

class LikeableComponent extends Component {
    public $item;
    public $likes;

    public function dehydrate()
    {
        $this->emit("post-change");
    }

    protected function get_likeable() {
        return (new Service(get_called_class()))->likeable();
    }

    public function likes_count() {
        return $this->item->likes->count();
    }

    public function delete()
    {
        $this->get_likeable()->delete($this->item->id);
    }

    public function like()
    {
        $this->get_likeable()->like($this->item->id);
    }

    public function unlike()
    {
        return $this->get_likeable()->unlike($this->item->id, auth()->id());
    }

    public function render_like_section()
    {
        return view("components.like-section", ["item" => $this->item])->render();
    }
}