<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Http\Controllers\Controller;
use App\Category;
use Storage;
use App\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.news.index', [
            'title' => 'News',
            'news'  => News::latest()->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create', [
            'title' => 'Add new News',
            'categories' => Category::all()
        ]);
    }


    public function store(StoreNewsRequest $request)
    {
        return $request->persist();
    }

    /**
     * Display the specified resource.
     * @param $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('admin.news.show', [
            'title' => "Show {$news->title}",
            'news'  => $news->load('creator', 'category'),
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     * @param News $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', [
            'title' => "Edit News",
            'news'  => $news,
            'categories' => Category::all()
        ]);
    }


    /**
     * Update the specified resource in storage.
     * @param News $news
     * @param UpdateNewsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(News $news, UpdateNewsRequest $request)
    {
        return $request->update($news);
    }

    /**
     * Remove the specified resource from storage.
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(News $news)
    {
        News::removeFiles($news);

        $news->delete();

        return redirect()->route('news.index')
            ->with('success', 'News has removed successfully');
    }
}
