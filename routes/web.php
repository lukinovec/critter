<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostLikeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;


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
    return view('posts');
});

Route::get('/get-posts', [PostController::class, 'index']);
Route::post('/new-post', [PostController::class, 'store']);
Route::post('/delete-post', [PostController::class, 'destroy']);

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::get('/get-post-likes', [PostLikeController::class, 'index']);
Route::post('/post-like', [PostLikeController::class, 'store']);
Route::post('/post-unlike', [PostLikeController::class, 'destroy']);

Route::get('/get-user', [ProfileController::class, 'index']);
Route::get('/user/{profile_id}', [ProfileController::class, 'show']);

require __DIR__ . '/auth.php';
