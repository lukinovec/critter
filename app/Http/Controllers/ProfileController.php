<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        return $request->user() ? Profile::with("posts", "postLikes.post")->find($request->user()->profile->id) : "User is not logged in";
    }

    public function show($profile_id)
    {
        return view('profile', [
            "profile" => Profile::find($profile_id)
        ]);
    }
}
