<?php

namespace App\Http\Requests\Dashboard\ServiceType;

use App\Bases\FormRequest\FormRequestBase;

class ServiceTypeRequest extends FormRequestBase
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title_ar' => 'required|min:4|max:255',
            'title_en' => 'required|min:4|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'title_ar.required' => __('message.title_ar_required'),
            'title_en.required' => __('message.title_en_required'),
            'title_ar.min' => __('message.title_ar_min'),
            'title_en.min' => __('message.title_en_min'),
            'title_ar.max' => __('message.title_ar_max'),
            'title_en.max' => __('message.title_en_max'),
        ];
    }
}
