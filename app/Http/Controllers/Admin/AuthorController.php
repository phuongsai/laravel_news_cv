<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = User::authors()->withCount('posts')->get();

        return view('admin.authors', compact('authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        User::onlyTrashed()->findOrFail($id)->restore();
        Toastr::success('Author Successfully Activated', 'Success');

        return back();
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        Toastr::success('Author Successfully Deleted', 'Success');

        return back();
    }
}
