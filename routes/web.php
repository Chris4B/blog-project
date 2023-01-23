<?php

use Illuminate\Support\Facades\Route;

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

//create a new route for the new folder html files "posts"

Route::get('posts/{post}', function ($slug) { //create a wildcard {post}


    //build path
    $path = __DIR__ . "/../resources/posts/{$slug}.html";


    //checking if path exists and redirect if not
    if (!file_exists($path)) {
        redirect('/');
    }

    // sotring in memory during x time
    $post = cache()->remember(
        "posts.{$slug}",
        5,
        fn () => file_get_contents($path)
    );

    // returning the content to the view
    return view('post', [
        'post' => $post
    ]);

    //add constraint for security issues.
})->where('post', '[A-z_\-]+');
