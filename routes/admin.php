<?php

/**
 * AdminDashboard Routes
 */


// Auth routes
Auth::routes(['register' => false]);

Route::group(['namespace' => 'Admin'], function(){
    Route::group(['middleware' => 'auth'], function(){
        // Show dashboard index page
        Route::get('/', 'DashboardController@index')->name('dashboard.index');
        // Show site settings page
        Route::get('/settings', 'SettingsController@index')->name('settings.index');
        // Update site settings
        Route::patch('/settings', 'SettingsController@update')->name('settings.update');
    });
});