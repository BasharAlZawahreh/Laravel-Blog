<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function index()
    {
        // Gate::allows('admin');

        $this->authorize('admin');
        return view('admin.posts.index', [
            'posts' => Post::paginate(50)
        ]);
    }

    public function create()
    {

        return view('posts.create');
    }

    public function store()
    {
        $attributes =array_merge($this->validateAttributes(),[
            'user_id'=>auth()->id(),
            'thumbnail'=>request()->file('thumbnail')->store('public/thumbnail')
        ]);

        Post::create($attributes);

        return redirect('/');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', [
            'post' => $post,
        ]);
    }

    public function update(Post $post)
    {
        $attributes = $this->validateAttributes(new Post());
        if (isset($attributes['thumbnail'])) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('public/thumbnails');
        }

        $post->update($attributes);

        return back()->with('success', 'post updated successfully!');
    }

    private function validateAttributes(?Post $post=null): array
    {
        $post??=new Post();
        return request()->validate([
            'title' => 'required|max:20|min:4',
            'body' => 'required|min:20',
            'slug' => ['required', Rule::unique('posts')->ignore($post->slug)],
            'thumbnail' => $post->exists ? ['image'] : ['required|image'],
            'excerpt' => 'required|max:255',
            'category_id' => 'required|exists:categories,id'
        ]);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', 'post deleted successfully!');
    }
}
