<?php

namespace App\Http\Requests;

use App\Setting;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSiteSettingsRequest extends FormRequest
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
            'site_name' => 'required|string|max:255',
            'site_email' => 'sometimes|nullable|string|email|max:255',
            'site_description' => 'sometimes|nullable|string|max:255',
            'site_keywords' => 'sometimes|nullable|string|max:255',
            'site_open'     => 'required|numeric|in:0,1',
            'site_maintenance_message' => 'sometimes|nullable|string|max:255'
        ];
    }

    /**
     * Update site settings
     * @param $settings
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function update($settings){
        $settings->update($this->only([
            'site_name', 'site_email', 'site_description', 'site_keywords',
            'site_open', 'site_maintenance_message'
        ]));

        // refresh site settings caching
        Setting::refreshCache($settings);

        session()->flash('success', 'Settings Updated Successfully');

        return back();
    }
}
