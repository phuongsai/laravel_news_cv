<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class HomePageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $trendingPosts = Post::lastDays(7)->approved()->published()
            ->orderBy('view_count', 'desc')->take(6)->get();
        $latestPosts = Post::latest()->approved()->published()->take(3)->get();
        $mostReadPosts = Post::approved()->published()
            ->orderBy('view_count', 'desc')->take(5)->get();
        $category = Category::whereSlug('tutorials')->first();
        if ($category) {
            $tutorial_posts = $category->posts()->approved()->published()
                ->orderBy('view_count', 'desc')->take(3)->get();
        } else {
            $tutorial_posts = []; // empty collection
            // $tutorial_posts = collect(new Post()); // empty collection
        }

        return view('guest.index', compact('trendingPosts', 'latestPosts', 'mostReadPosts', 'tutorial_posts'));
    }
}
