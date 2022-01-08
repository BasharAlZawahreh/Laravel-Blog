<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index()
    {
        $posts =
            Post::latest()
            ->filter(
                request(['search', 'category', 'author'])
            )
            ->paginate()
            ->withQueryString();

        return view('posts.index', [
            "posts" => $posts,
            'currentCategory' => Category::firstWhere('slug', request('category'))
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }


}
