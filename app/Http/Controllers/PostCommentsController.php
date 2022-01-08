<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
    public function store(Post $post)
    {
        request()->validate([
            'body' => 'required|max:255',
        ]);
        $post->comments->create([
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);

        return back();
    }
}
