<?php

namespace App\Http\Livewire;

use App\Models\Profile;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProfileComponent extends Component
{
    public $item;
    protected $listeners = ["post-change" => "mount"];

    public function mount(Profile $profile)
    {
        $this->item = $profile->exists ? $profile : Profile::find($this->item->id);
    }

    public function render()
    {
        return view('livewire.profile-component', [
            "profile" => $this->item,
        ])->extends('template.layout');
    }
}
