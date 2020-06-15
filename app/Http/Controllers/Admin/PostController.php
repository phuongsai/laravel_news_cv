<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Notifications\AuthorPostApproved;
use Brian2694\Toastr\Facades\Toastr;

class PostController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param \App\Post $post
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.post.show', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        Post::withTrashed()->findOrFail($id)->restore();
        Toastr::success('Post Successfully Activated', 'Success');

        return back();
    }

    public function pending()
    {
        $posts = Post::where('is_approved', false)->get();

        return view('admin.post.pending', compact('posts'));
    }

    public function approval($id)
    {
        $post = Post::findOrFail($id);
        if (false == $post->is_approved) {
            $post->is_approved = true;
            $post->update();
            $post->user->notify(new AuthorPostApproved($post));

            Toastr::success('Post Successfully Approved :)', 'Success');
        } else {
            $post->is_approved = false;
            $post->update();
            $post->user->notify(new AuthorPostApproved($post));
            Toastr::success('Post Successfully Un-approved :)', 'Success');
        }

        return redirect()->route('admin.post.pending');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Post $post
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        Toastr::success('Post Successfully Deleted :)', 'Success');

        return back();
    }
}
