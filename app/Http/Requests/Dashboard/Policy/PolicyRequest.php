<?php

namespace App\Http\Requests\Dashboard\Policy;

use App\Http\RequestHandler\RequestHandle;
use Illuminate\Foundation\Http\FormRequest;

class PolicyRequest extends RequestHandle
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'description_ar' => 'required|min:4|max:255',
            'description_en' => 'required|min:4|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'description_ar.required' => __('message.description_ar_required'),
            'description_en.required' => __('message.description_en_required'),
            'description_ar.min' => __('message.description_ar_min'),
            'description_en.min' => __('message.description_en_min'),
            'description_ar.max' => __('message.description_ar_max'),
            'description_en.max' => __('message.description_en_max'),
        ];
    }
}
