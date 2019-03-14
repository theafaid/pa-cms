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
if(('settings')){
    function settings($key = null){

        if(cache($cacheKey = 'settings') && cache('settings') != null){
            $settings = cache($cacheKey);
        }else{
            $settings = cache()->rememberForever($cacheKey, function(){
                return \App\Setting::first() ?: null;
            });
        }

        if(! is_null($settings)){
            return $key ? $settings[$key] : $settings;
        }

        return null;
    }
}