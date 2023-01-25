<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Post
{

    //find a post by its slug

    public static function find($slug)
    {
        //build path from resource folder
        $path = resource_path("posts/{$slug}.html");


        //checking if path exists and redirect if not
        if (!file_exists($path)) {
            throw new ModelNotFoundException();
        }

        // storing in memory during x time
        return cache()->remember(
            "posts.{$slug}",
            1200,
            fn () => file_get_contents($path)
        );
    }

    //find all posts
    public static function all()
    {
        //File (facade) gives several methods to deal with files
        //File::files read the directory of a file.
        $files = File::files(resource_path("posts/"));

        return array_map(function ($file) {

            return $file->getContents();
        }, $files);
    }
}
