<?php

namespace App\Http\Livewire;

use App\Models\Profile;
class ProfileComponent extends ParentComponent
{
    public $item;
    protected $listeners = ["item-change" => "mount"];

    public function mount(Profile $profile)
    {
        $this->item = $profile->exists ? $profile : Profile::find($this->item->id);
    }

    public function editImage()
    {
        $this->dispatchBrowserEvent("swal:edit-profile-image", [
            "user_id" => auth()->id()
        ]);
    }

    public function confirmEdit()
    {
        $this->item->update([
            "image" => $this->image_name
        ]);

        $this->emit("item-change");
    }

    public function render()
    {
        return view('livewire.profile-component', [
            "profile" => $this->item,
        ])->extends('template.layout');
    }
}
