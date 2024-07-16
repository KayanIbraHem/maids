<?php

namespace App\Http\Requests\Dashboard\Maid;

use App\Http\RequestHandler\RequestHandle;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMaidRequest extends RequestHandle
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'first_name' => 'required|min:4|max:255',
            'last_name' => 'required|min:4|max:255',
            'phone' => 'nullable|unique:maids,phone,' . $this->maid,
            'age' => 'required|numeric|min:1|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'cv' => 'nullable|mimes:pdf',
            'nationality_id' => 'required|exists:nationalities,id',
            'service_type_id' => 'required|exists:service_types,id',
        ];
    }
    public function messages(): array
    {
        return [
            'first_name.required' => __('auth.first_name_required'),
            'first_name.min' => __('auth.first_name_min'),
            'first_name.max' => __('auth.first_name_max'),
            'last_name.required' => __('auth.last_name_required'),
            'last_name.min' => __('auth.last_name_min'),
            'last_name.max' => __('auth.last_name_max'),
            'phone_unique' => __('auth.phone_unique'),
            'age.required' => __('auth.age_required'),
            'age.numeric' => __('auth.age_numeric'),
            'age.min' => __('auth.age_min'),
            'image.mimes' => __('auth.image_mimes'),
            'cv.mimes' => __('auth.cv_mimes'),
            'nationality_id.required' => __('auth.nationality_required'),
            'service_type_id.required' => __('auth.service_type_required'),
        ];
    }
}
