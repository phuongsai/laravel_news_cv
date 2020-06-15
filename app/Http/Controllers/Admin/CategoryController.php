<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriesUpdateRequest;
use App\Http\Requests\CategoryValidationRequest;
use App\Models\Category;
use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index')
            ->withCategories(Category::latest()->with('posts')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryValidationRequest $request)
    {
        try {
            $category = new Category();
            $category->name = $request->name;
            $category->slug = $request->name;
            $category->save();
        } catch (\Exception $e) {
            Toastr::error('Something went wrong!', 'Error');

            return back();
        }

        Toastr::success('Category Successfully Saved :)', 'Success');

        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if (strtolower($category->name) == 'other') {
            Toastr::error('Can not delete default category', 'Error');

            return back();
        }

        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriesUpdateRequest $request, Category $category)
    {
        try {
            $category->name = $request->name;
            $category->slug = $request->name;
            $category->update();
        } catch (\Exception $e) {
            Toastr::error('Something went wrong!', 'Error');

            return back();
        }

        Toastr::success('Category Successfully Updated :)', 'Success');

        return redirect()->route('admin.category.index');
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
        // prevent delete default category for update logic below
        $category = Category::findOrFail($id);
        if (strtolower($category->name) == 'other') {
            Toastr::error('Can not delete default category', 'Error');

            return back();
        }
        // update new value for each post before delete category
        $category->posts()->whereCategoryId($id)->update(['category_id' => 1]); // default record 'other'
        // $category->posts()->wherePivot('category_id', $id)->updateExistingPivot($id, ['category_id' => 0]);
        // $category->posts()->detach();
        $category->delete();
        Toastr::success('Category Successfully Deleted :)', 'Success');

        return back();
    }
}
