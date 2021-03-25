<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Helpers\Service;
use Illuminate\Support\Facades\Storage;

class ParentComponent extends Component {
    protected $listeners = ["item-change" => "mount",  "upload-image" => "saveImage"];
    public $image_name = "";

    public function uploadImage()
    {
        $this->dispatchBrowserEvent("swal:upload-image", [
            "user_id" => auth()->id(),
            "parent" => (new Service(get_called_class()))->name()
        ]);
    }

    public function saveImage($upload)
    {
        $upload["image"] = str_replace('data:image/jpeg;base64,', '', $upload["image"]);
        $upload["image"] = str_replace('data:image/png;base64,', '', $upload["image"]);
        $upload["image"] = str_replace(' ', '+', $upload["image"]);
        switch($upload["parent"]) {
            case "profile":
                $this->image_name = "user_uploads/profile" . auth()->id() . ".jpg";
            case "post":
                $this->image_name = "user_uploads/" . ((string) time()) . ".jpg";
        }
        Storage::put($this->image_name, base64_decode($upload["image"]));
    }
}