<?php

namespace App\Http\Requests\Dashboard\NationalityType;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Bases\FormRequest\FormRequestBase;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNationalityTypeRequest extends FormRequestBase
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {

        return [
            'nationality_id' => [
                'required',
                'exists:nationalities,id',
                Rule::unique('nationality_types')->where(function ($query) {
                    return $query->where('service_type_id', $this->service_type_id);
                })->ignore($this->nationality_type),
            ],
            'service_type_id' => [
                'required',
                'exists:service_types,id',
                Rule::unique('nationality_types')->where(function ($query) {
                    return $query->where('nationality_id', $this->nationality_id);
                })->ignore($this->nationality_type),
            ],
            'price' => 'required|numeric',
        ];
    }
    public function messages(): array
    {
        return [
            'nationality_id.required' => __('message.nationality_id_required'),
            'nationality_id.exists' => __('message.nationality_id_exists'),
            'service_type_id.required' => __('message.service_type_id_required'),
            'service_type_id.exists' => __('message.service_type_id_exists'),
            'price.required' => __('message.price_required'),
            'price.numeric' => __('message.price_numeric'),
            'nationality_id.unique' => __('message.nationality_service_type_unique'),
            'service_type_id.unique' => __('message.nationality_service_type_unique'),
        ];
    }
}
