<?php

namespace App\Http\Requests\Dashboard\Slider;

use App\Http\RequestHandler\RequestHandle;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSliderRequest extends RequestHandle
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
            'link' => 'url|nullable',
        ];
    }
    public function messages(): array
    {
        return [
            'image.mimes' => __('message.image_mimes'),
            'image.image' => __('message.image_invalid'),
            'link.url' => __('message.link_url'),
        ];
    }
}
