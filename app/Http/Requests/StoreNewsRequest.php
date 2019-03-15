<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\News;
use Illuminate\Support\Facades\Storage;

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
            'main_photo'  => $this->storePhoto($this->main_photo),
            'images'      => $this->storePhoto($this->images),
            'category_id' => $this->category_id,
            'body'        => $this->body,
        ]);

        return redirect()->route('news.show', $news->slug)
            ->with('success', 'News has created successfully');
    }

    /**
     * Store a photo for the news
     * it store images as a json filed in news table
     * so no need for making new table with relations
     * @param $images
     * @return mixed
     */
    private function storePhoto($images){

        if(is_array($images)){
            $pathes = [];

            foreach($images as $img){
                $path = Storage::put('news', $img);
                array_push($pathes, $path);
            }

            return json_encode($pathes);
        }

        return Storage::put('news', $images);
    }
}
