<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSiteSettingsRequest;
use App\Setting;

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

    /**
     * Update site settings
     * @param UpdateSiteSettingsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function update(UpdateSiteSettingsRequest $request){
        $settings = Setting::first();
        return $request->update($settings);
    }
}
