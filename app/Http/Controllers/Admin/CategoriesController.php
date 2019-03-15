<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index', [
            'title'      => 'Categories',
            'categories' => Category::paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create', [
            'title' => 'Create New Category',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = request()->validate([
            'name' => 'required|string|max:255|unique:categories,name'
        ]);

        Category::create([
            'name'       => $data['name'],
            'creator_id' => auth()->id(),
            'slug'       => $data['name']
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Category Created Successfully');
    }

    /**
     * Show a specified resource
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', [
            'title' => "Show {$category->name}",
            'category' => $category->load('creator'),
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', [
            'title' => "Edit {$category->name}",
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Category $category)
    {
        $data = request()->validate([
            'name' => 'required|string|max:255|unique:categories,name,'.$category->id
        ]);

        $category->update([
            'name' => $data['name'],
            'slug' => $data['name']
        ]);
        return redirect()->route('categories.show', $category->fresh()->slug)
            ->with('success', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category Has Deleted Successfully');
    }
}
