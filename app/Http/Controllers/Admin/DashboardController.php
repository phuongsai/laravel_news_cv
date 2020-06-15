<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $popular_posts = Post::whereStatus('1')->with('user')
            ->orderBy('view_count', 'desc')
            ->take(5)->get();
        $total_pending_posts = Post::where('is_approved', false)->count();
        $all_views = Post::sum('view_count');
        $author_count = User::withTrashed()->where('role_id', 2)->count();
        $new_authors_today = User::where('role_id', 2)
            ->whereDate('created_at', Carbon::today())->count();
        $active_authors = User::where('role_id', 2)
            ->withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->take(10)->get();
        $total_posts = Post::all()->count();
        $category_count = Category::all()->count();
        $tag_count = Tag::all()->count();

        return view('admin.dashboard', compact('total_posts', 'popular_posts', 'total_pending_posts', 'all_views', 'author_count', 'new_authors_today', 'active_authors', 'category_count', 'tag_count'));
    }
}
