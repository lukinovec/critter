<?php

use App\Http\Livewire\ProfileComponent;
use App\Http\Livewire\Post;
use App\Http\Livewire\Posts;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', Posts::class)->name("dashboard");

Route::get('/post/{post_id}', Post::class)->name("show-post");

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name("logout");

Route::get('/user/{profile}', ProfileComponent::class)->name('profile');

require __DIR__ . '/auth.php';
