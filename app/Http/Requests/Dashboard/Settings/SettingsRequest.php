<?php

namespace App\Http\Requests\Dashboard\Settings;

use App\Http\RequestHandler\RequestHandle;
use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends RequestHandle
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|min:4|max:255',
            'phone' => 'required|min:4|max:255',
            'address' => 'required|min:3|max:255',
            'whatsapp' => 'required|min:8|max:255',
            'facebook' => 'nullable|url|min:17|max:255',
            'x' => 'nullable|url|min:17|max:255',
            'youtube' => 'nullable|url|min:17|max:255',
            'instagram' => 'nullable|url|min:17|max:255',
            'linkedin' => 'nullable|url|min:17|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => __('message.name_required'),
            'name.min' => __('message.name_min'),
            'name.max' => __('message.name_max'),
            'phone.required' => __('message.phone_required'),
            'phone.min' => __('message.phone_min'),
            'phone.max' => __('message.phone_max'),
            'address.required' => __('message.address_required'),
            'address.min' => __('message.address_min'),
            'address.max' => __('message.address_max'),
            'whatsapp.required' => __('message.whatsapp_required'),
            'whatsapp.min' => __('message.whatsapp_min'),
            'whatsapp.max' => __('message.whatsapp_max'),
            'x.min' => __('message.x_url_min'),
            'x.max' => __('message.x_url_max'),
            'x.url' => __('message.x_url'),
            'youtube.min' => __('message.youtube_url_min'),
            'youtube.max' => __('message.youtube_url_max'),
            'youtube.url' => __('message.youtube_url'),
            'instagram.min' => __('message.instagram_url_min'),
            'instagram.max' => __('message.instagram_url_max'),
            'instagram.url' => __('message.instagram_url'),
            'linkedin.min' => __('message.linkedin_url_min'),
            'linkedin.max' => __('message.linkedin_url_max'),
            'linkedin.url' => __('message.linkedin_url'),
        ];
    }
}
