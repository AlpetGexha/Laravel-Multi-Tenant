<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return $posts;
        // return view('post.index', compact('posts'));
    }

    public function single(Post $post)
    {
        return $post;
        // return view('post.show', compact('post'));
    }
}
