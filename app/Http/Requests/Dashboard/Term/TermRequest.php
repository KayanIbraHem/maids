<?php

namespace App\Http\Requests\Dashboard\Term;

use App\Bases\FormRequest\FormRequestBase;
use Illuminate\Foundation\Http\FormRequest;

class TermRequest extends FormRequestBase
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
            'description_ar' => 'required|min:4|max:255',
            'description_en' => 'required|min:4|max:255',
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
            'description_ar.required' => __('message.description_ar_required'),
            'description_en.required' => __('message.description_en_required'),
            'description_ar.min' => __('message.description_ar_min'),
            'description_en.min' => __('message.description_en_min'),
            'description_ar.max' => __('message.description_ar_max'),
            'description_en.max' => __('message.description_en_max'),
        ];
    }
}
