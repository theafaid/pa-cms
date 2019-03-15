<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    protected $table = 'news';
    protected $guarded = [];
    protected $with = ['category'];

    protected static function boot(){
        parent::boot();

        static::deleting(function($news){
            static::removeFiles($news, true, true);
        });
    }

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
    public static function removeFiles($news, $main = true, $others = true){

        if($main && $others){

            static::removeMain($news);
            static::removeOthers($news);

        }elseif($main && ! $others){

           static::removeMain($news);

        }elseif(! $main && $others){

            static::removeOthers($news);

        }else{
            return;
        }
    }

    /**
     * Remove main image for a specific news
     * @param $news
     */
    protected static function removeMain($news){
        Storage::delete($news->main_photo);
    }

    /**
     * Remove sub images for a specific news
     * @param $news
     */
    protected static function removeOthers($news){
        if($images = $news->images){
            foreach(json_decode($images) as $img){
                Storage::delete($img);
            }
        }
    }
}
