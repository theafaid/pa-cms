<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $guarded = [];

    use HasSlug;

    /**
     * Get the creator of the category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator(){
        return $this->belongsTo('App\User', 'creator_id', 'id');
    }

    /**
     * Get news for this category
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function news(){
        return $this->hasMany('App\News');
    }
}
