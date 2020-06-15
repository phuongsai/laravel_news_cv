<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostValidationRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use JD\Cloudder\Facades\Cloudder;
use App\Notifications\NewAuthorPost;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (1 == Auth::id()) {
            $posts = Post::withTrashed()->with('user')->latest()->get();
        } else {
            $posts = Auth::user()->posts()->latest()->get();
        }

        return view('author.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all(['id', 'name']);
        $tags = Tag::all(['id', 'name']);

        return view('author.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PostValidationRequest $request)
    {
        try {
            $image = $request->file('image');
            $title = $request->title;
            if (isset($image)) {
                // CLOUDINARY UPLOAD
                $upload = Cloudder::upload($image, 'posts/' . $image);

                if ($upload) {
                    // assign new image
                    $image_id = Cloudder::getPublicId();
                    $image_url = Cloudder::show($image_id);
                } else {
                    Toastr::error('Upload image failed!', 'Error');

                    return back();
                }
            } else {
                $image_url = defaultPostImage();
                $image_id = null;
            }
            $userID = Auth::id();
            $post = new Post();
            $post->user_id = $userID;
            $post->title = $title;
            $post->slug = $title;   // using the mutator setSlugAttribute()
            $post->image = $image_url;
            $post->image_id = $image_id;
            $post->body = $request->body;

            if (isset($request->status)) {
                $post->status = true;
            } else {
                $post->status = false;
            }

            if (1 == $userID) {
                $post->is_approved = true;
            } else {
                $post->is_approved = false;
                $this->review($post);
            }

            $post->save();

            $post->categories()->sync($request->categories, false); // syncWithoutDetaching
            $post->tags()->sync($request->tags, false);

            Toastr::success('Post Successfully Saved :)', 'Success');

            return redirect()->route('auth.posts.index');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong!', 'Error');
            // Toastr::error($e, 'Error');

            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Post $post
     * @param mixed     $postSlug
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // check role is admin
        $this->middleware('admin');

        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Post $post
     * @param mixed     $postSlug
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $userID = Auth::id();
        if ($post->user_id == $userID || 1 == $userID) {
            $categories = Category::all(['id', 'name']);
            $tags = Tag::all(['id', 'name']);

            return view('author.post.edit', compact('post', 'categories', 'tags'));
        }
        Toastr::error('You are not authorized to access this post', 'Error');

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Post $post
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PostValidationRequest $request, Post $post)
    {
        try {
            $userID = Auth::id();
            if ($post->user_id == $userID || 1 == $userID) {
                $image = $request->file('image');
                if (isset($image)) {
                    // CLOUDINARY UPLOAD
                    $upload = Cloudder::upload($image, 'posts/' . $image);

                    if ($upload) {
                        // delete old image when image_id NOT NULL
                        if (null != $post->image_id) {
                            Cloudder::delete($post->image_id);
                        }
                        // assign new image
                        $image_id = Cloudder::getPublicId();
                        $image_url = Cloudder::show($image_id);
                    } else {
                        Toastr::error('Upload image failed!', 'Error');

                        return back();
                    }
                } else {
                    $image_url = $post->image;
                    $image_id = null;
                }

                $post->user_id = $userID;
                $post->title = $request->title;
                $post->image_id = $image_id;
                $post->image = $image_url;
                $post->body = $request->body;

                if (isset($request->status)) {
                    $post->status = true;
                } else {
                    $post->status = false;
                }

                if (1 === $userID) {
                    $post->is_approved = true;
                } else {
                    $post->is_approved = false;
                }

                if (isset($request->review)) {
                    $this->review($post);
                }
                $post->update();

                $post->categories()->sync($request->categories);
                $post->tags()->sync($request->tags);



                Toastr::success('Post Successfully Updated :)', 'Success');

                return redirect()->route('auth.posts.index');
            }
            Toastr::error('You are not authorized to access this post', 'Error');

            return back();
        } catch (\Exception $e) {
            Toastr::error('Can not save! Please check valid input length of content!', 'Error');

            return back();
        }
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
        // check role is admin
        $this->middleware('admin');

        if (1 !== $post->user_id) {
            Toastr::error('You are not authorized to access this post', 'Error');

            return back();
        }

        return back();
    }

    public function requestReview(Post $post)
    {
        if ($this->review($post)) {
            Toastr::success('Successfully request review post!', 'Success');
            return back();
        }
        Toastr::error('Can not request review. Please contact to admin!', 'Error');

        return back();
    }

    protected function review(Post $post)
    {

        $users = \App\Models\User::where('role_id', '1')->get();

        if (!$users->isEmpty()) {
            foreach ($users as $user) {
                Notification::send($user, new NewAuthorPost($post));
            }

            return true;
        }

        return false;
    }
}
