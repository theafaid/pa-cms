<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = [];

    /**
     * Refresh site settings caching
     * @param $settings
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public static function refreshCache($settings){
        if(cache()->has(static::cacheKey())){
            cache()->forget(static::cacheKey());
        }

        cache()->rememberForever(static::cacheKey(), function() use ($settings){
            return $settings;
        });
    }

    /**
     * Get site settings cache key
     * @return string
     */
    protected static function cacheKey(){
        return "settings";
    }
}
