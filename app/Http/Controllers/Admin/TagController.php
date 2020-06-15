<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagValidationRequest;
use App\Models\Tag;
use Brian2694\Toastr\Facades\Toastr;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tag.index')
            ->withTags(Tag::latest()->withCount('posts')->get());

        /*
        $tags = Tag::latest()->get();
        return view('admin.tag.index', compact('tags'));
        */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(TagValidationRequest $request)
    {
        try {
            $tag = new Tag();
            $tag->name = $request->name;
            $tag->slug = $request->name;
            dump($tag);
            $tag->save();
            dd('saved!');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong!', 'Error');

            return back();
        }

        Toastr::success('Tag Successfully Saved :)', 'Success');

        return redirect()->route('admin.tag.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        if (strtolower($tag->name) == 'other') {
            Toastr::error('Can not delete default category', 'Error');

            return back();
        }
        return view('admin.tag.edit')->withTag($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(TagValidationRequest $request, Tag $tag)
    {
        try {
            $tag->name = $request->name;
            $tag->slug = $request->name;
            $tag->save();
        } catch (\Exception $e) {
            Toastr::error('Something went wrong!', 'Error');

            return back();
        }

        Toastr::success('Tag Successfully Updated :)', 'Success');

        return redirect()->route('admin.tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        if (strtolower($tag->name) == 'other') {
            Toastr::error('Can not delete default category', 'Error');

            return back();
        }
        // update new value for each post before delete tag
        $tag->posts()->whereTagId($id)->update(['tag_id' => 1]); // default record 'other'
        $tag->posts()->detach();
        $tag->delete();
        Toastr::success('Tag Successfully Deleted :)', 'Success');

        return back();
    }
}
