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
    });
});