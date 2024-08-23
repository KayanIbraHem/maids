<?php

namespace App\Http\Requests\Api\User\Auth;

use App\Bases\FormRequest\FormRequestBase;
use Illuminate\Foundation\Http\FormRequest;

class ApiLoginRequest extends FormRequestBase
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'phone' => 'required',
            'password' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'phone.required' => __('auth.phone_required'),
            'password.required' => __('auth.password_required'),
        ];
    }
}
