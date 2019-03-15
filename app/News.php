<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $guarded = [];

    use HasSlug;

    /**
     * Get the creator of this news
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator(){
        return $this->belongsTo('App\User', 'creator_id', 'id');
    }

    /**
     * Get the category for a specified news
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(){
        return $this->belongsTo('App\Category');
    }

    /**
     * @param $value
     * @return string
     */
    public function getMainPhotoAttribute($value){
        return "/storage/{$value}";
    }
}
