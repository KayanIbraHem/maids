<?php

namespace App\Http\Requests\Dashboard\Maid;

use App\Bases\FormRequest\FormRequestBase;
use Illuminate\Foundation\Http\FormRequest;

class StoreMaidRequest extends FormRequestBase
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|min:4|max:255',
            'age' => 'nullable|numeric|min:1|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'cv' => 'nullable|mimes:pdf',
            'nationality_id' => 'required|exists:nationalities,id',
            'service_type_id' => 'required|exists:service_types,id',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => __('auth.name_required'),
            'name.min' => __('auth.name_min'),
            'name.max' => __('auth.name_max'),
            'age.required' => __('auth.age_required'),
            'age.numeric' => __('auth.age_numeric'),
            'age.min' => __('auth.age_min'),
            'image.mimes' => __('auth.image_mimes'),
            'cv.mimes' => __('auth.cv_mimes'),
            'nationality_id.required' => __('auth.nationality_id_required'),
            'nationality_id.exists' => __('auth.nationality_id_exists'),
            'service_type_id.required' => __('auth.service_type_id_required'),
            'service_type_id.exists' => __('auth.service_type_id_exists'),
        ];
    }
}
