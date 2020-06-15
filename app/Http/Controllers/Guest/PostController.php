<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->approved()->published()->with('categories:name,slug')->simplePaginate(6);

        return view('guest.posts', compact('posts'));
    }

    public function details($slug)
    {
        $post = Post::whereSlug($slug)->approved()->published()->with('categories:name,slug')->with('user')->firstOrFail();
        $blogKey = 'blog_' . $post->id;

        if (!Session::has($blogKey)) {
            $post->increment('view_count');
            Session::put($blogKey, 1);
        }

        $nextPost = Post::where('id', '>', $post->id)->approved()->published()->orderBy('id')->first();
        $prevPost = Post::where('id', '<', $post->id)->approved()->published()->orderBy('id', 'desc')->first();

        return view('guest.post', compact('post', 'nextPost', 'prevPost'));
    }

    public function postByCategory($slug)
    {
        $category = Category::whereSlug($slug)->firstOrFail();
        $posts = $category->posts()->latest()->approved()->published()->simplePaginate(12);

        return view('guest.category', compact('category', 'posts'));
    }

    public function postByTag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $posts = $tag->posts()->approved()->published()->simplePaginate(6);

        return view('guest.tag', compact('tag', 'posts'));
    }
}
