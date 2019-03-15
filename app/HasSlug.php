<?php

namespace App;

use Illuminate\Support\Str;

trait HasSlug{

    public function getRouteKeyName()
    {
        return "slug";
    }

    /**
     * Validate the slug attribute for the news
     * it should be unique
     * @param $title
     */
    public function setSlugAttribute($title){
        if(static::whereSlug($slug = Str::slug($title))->where('id', '!=', $this->id)->exists()){
            $slug = $slug ."_". time();
        }
        $this->attributes['slug'] = $slug;
    }

}