<?php

namespace App\Http\Livewire;

use App\Models\Profile;
use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;

class UserSearch extends Component
{
    public $users;
    public $search;
    protected $results;

    public function mount()
    {
        $this->users = Profile::all();
    }

    public function updatedSearch($search)
    {
        if(strlen($search) == 0) {
            $this->reset("results");
        } else {
            $this->results = $this->users->filter(function($user) use ($search) {
                return false !== stripos($user->nickname, $search);
            });
        }
    }

    public function render()
    {
        return view('livewire.user-search', [
            "results" => $this->results
        ]);
    }
}
