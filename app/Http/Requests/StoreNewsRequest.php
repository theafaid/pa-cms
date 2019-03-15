<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\News;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;

class StoreNewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'       => 'required|string|max:255',
            'main_photo'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|numeric|exists:categories,id',
            'body'        => 'required|string',
            'image.*'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    /**
     * Persist storing a news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function persist(){
        $news = News::create([
            'creator_id'  => auth()->id(),
            'title'       => $this->title,
            'slug'        => $this->title,
            'main_photo'  => $this->upload($this->main_photo),
            'images'      => $this->upload($this->images),
            'category_id' => $this->category_id,
            'body'        => $this->body,
        ]);

        return redirect()->route('news.show', $news->slug)
            ->with('success', 'News has created successfully');
    }

    /**
     * Upload a photos for the news
     * it store images as a json filed in news table
     * so no need for making new table with relations
     * @param $images
     * @return mixed
     */
    private function upload($images){

        if(is_array($images)){
            $pathes = [];

            foreach($images as $img){
                array_push($pathes, $this->storeImage($img, 400, 400));
            }

            return json_encode($pathes);
        }

       return $this->storeImage($images, 600, 600);
    }

    /**
     * Store Image to a news
     * @param $img, $width, $height
     * @return mixed
     */
    private function storeImage($img, $width = 400, $height = 400){
        $path = Storage::put('news', $img);

        ImageManagerStatic::make(Storage::url($path))->resize($width,$height)
            ->save(storage_path('app/public/news/'.$img->hashname()));

        return $path;
    }
}
