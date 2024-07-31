<?php

namespace App\Http\Requests\Api\ServiceType;

use App\Http\RequestHandler\RequestHandle;

class ApiFetchServiceTypeByIdRequest extends RequestHandle
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // 'service_type_id' => 'required|exists:service_types,id|numeric',
        ];
    }
    public function messages(): array
    {
        return [
            // 'service_type_id.required' => __('message.service_type_id_required'),
            // 'service_type_id.exists' => __('message.service_type_id_exists'),
            // 'service_type_id.numeric' => __('message.service_type_id_numeric'),
        ];
    }
}
