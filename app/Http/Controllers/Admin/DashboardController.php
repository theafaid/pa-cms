<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Category;
use App\News;

class DashboardController extends Controller
{
    /**
     * Show dashboard home page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('admin.index', [
            'title' => 'Dashboard',
            'data' => $this->getStatistics()
        ]);
    }

    /**
     * Get Count for [categories, news]
     * @return array
     */
    public function getStatistics(){
        return [
            [
                'icon'  => 'fa fa-list',
                'title' => 'Categories Count',
                'value' => Category::count()
            ],
            [
                'icon'  => 'fa fa-newspaper-o',
                'title' => 'News Count',
                'value' => News::count()
            ]
        ];
    }
}
