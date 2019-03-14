<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    /**
     * Show site settings edit page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        return view('admin.settings.index', [
            'title' => "Settings",
            'settings' => settings()
        ]);
    }
}
