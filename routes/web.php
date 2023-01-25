<?php

use Illuminate\Support\Facades\Route;
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

    $posts = Post::all();

    return view('posts', [
        'posts' => $posts
    ]);
});

// //create a new route for the new folder html files "posts"

Route::get('posts/{post}', function ($slug) { //create a wildcard {post}

    // returning the content to the view
    return view('post', [
        'post' => Post::find($slug)
    ]);

    //add constraint for security issues.
})->where('post', '[A-z_\-]+');
