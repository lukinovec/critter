<?php
namespace App\Http\Livewire;

use Livewire\Component;

class ParentComponent extends Component {
    protected $listeners = ["post-change" => "mount"];
}