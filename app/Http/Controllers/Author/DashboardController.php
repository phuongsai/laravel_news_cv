<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $posts = $user->posts;
        $popular_posts = $user->posts()->orderBy('view_count', 'desc')->take(5)->get();
        $total_pending_posts = $posts->where('is_approved', false)->count();
        $total_posts = $posts->count();
        $all_views = $posts->sum('view_count');

        return view('author.dashboard', compact('total_posts', 'popular_posts', 'total_pending_posts', 'all_views'));
    }
}
