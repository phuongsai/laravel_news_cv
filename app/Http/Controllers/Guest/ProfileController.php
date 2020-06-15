<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param mixed $username
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke($username)
    {
        $author = User::whereUsername(Str::lower($username))->firstOrFail();
        $posts = $author->posts()->approved()->published()->with('categories')->simplePaginate(6);

        return view('guest.profile', compact('author', 'posts'));
    }
}
