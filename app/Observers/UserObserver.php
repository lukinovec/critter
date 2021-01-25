<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Profile;

class UserObserver
{
    public function created(User $user)
    {
        // Create profile

        Profile::create([
            "user_id" => $user->id,
            "nickname" => $user->name,
            "image" => url(asset('/user.png'))
        ]);
    }
}
