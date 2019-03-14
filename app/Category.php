<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $guarded = [];

    /**
     * Validate the slug attribute for the cateogry
     * it should be unique
     * @param $title
     */
    public function setSlugAttribute($title){
        if(static::whereSlug($slug = Str::slug($title))->exists()){
            $slug = $slug . time();
        }
        $this->attributes['slug'] = $slug;
    }
}
