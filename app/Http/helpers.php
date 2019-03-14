<?php

/**
 * Get Dashboard Path
 */

if(! function_exists('aurl')){
    function aurl($url = null){
        return "/dashboard/{$url}";
    }
}

/**
 * Get site settings
 */
if(! function_exists('settings')){
    function settings($key = null){

        if(cache($cacheKey = 'settings') && cache('settings') != null){
            $settings = cache($cacheKey);
        }else{
            $settings = \App\Setting::first();
            \App\Setting::refreshCache($settings);
        }

        if(! is_null($settings)){
            return $key ? $settings[$key] : $settings;
        }

        return null;
    }
}

/**
 * Mark active link
 */

if(! function_exists('is_active_link')){
    function is_active_link($segment = null){
        $reqSegment = request()->segment(2);

        if($reqSegment == null && $segment == null) return true;

        return $reqSegment == $segment;
    }
}