<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Profile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('posts', [
        "posts" => Post::all()
    ]);
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::post('/post-crit', function () {
    Post::create([
        "profile_id" => Auth::id(),
        "text" => request("crit"),
    ]);
    return redirect('/');
});

Route::get('/user/{profile_id}', function ($profile_id) {
    return view('profile', [
        "profile" => Profile::find($profile_id)
    ]);
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
