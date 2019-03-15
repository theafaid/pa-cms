<?php

namespace App\Http\Requests;

use App\News;
use Illuminate\Foundation\Http\FormRequest;
use Intervention\Image\ImageManagerStatic;
use Storage;

class UpdateNewsRequest extends FormRequest
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
            'main_photo'  => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|numeric|exists:categories,id',
            'body'        => 'required|string',
            'images.*'     => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    /**
     * Persist storing a news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($news){
        $news->update([
            'creator_id' => auth()->id(),
            'title' => $this->title,
            'slug' => $this->title,
            'main_photo' => $this->main_photo ? $this->upload($this->main_photo, $news, 'main') : $news->main_photo,
            'category_id' => $this->category_id,
            'body' => $this->body,
            'images' => $this->images ? $this->upload($this->images, $news, 'others') : $news->images
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
    private function upload($images, $news){

        if(is_null($images)) return null;

        News::removeFiles($news, $this->has('main_photo'), $this->has('images'));

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
