<?php

namespace App\Http\Requests\Dashboard\Slider;

use App\Bases\FormRequest\FormRequestBase;
use Illuminate\Foundation\Http\FormRequest;

class StoreSliderRequest extends FormRequestBase
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => 'Required|image|mimes:png,jpg,jpeg',
            'link' => 'url|Required',
        ];
    }
    public function messages(): array
    {
        return [
            'image.required' => __('message.image_required'),
            'image.mimes' => __('message.image_mimes'),
            'image.image' => __('message.image_invalid'),
            'link.url' => __('message.link_url'),
            'link.required' => __('message.link_required'),
        ];
    }
}
