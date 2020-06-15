<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        if ($query) {
            $posts = Post::where('title', 'LIKE', "%{$query}%")->approved()->published()->with('categories')->simplePaginate(6);

            return view('guest.search', compact('posts', 'query'));
        }

        return view('guest.search');
    }
}
