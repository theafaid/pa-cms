<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    protected $table = 'news';
    protected $guarded = [];
    protected $with = ['category'];

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
     * Remove news files from storage
     * @param $news
     */
    public static function removeFiles($news){

        Storage::delete($news->main_photo);

        if($images = $news->images){
            foreach(json_decode($images) as $img){
                Storage::delete($img);
            }
        }
    }
}
