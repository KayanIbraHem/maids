<?php

namespace App\Http\Requests\Api\User\Auth;

use App\Http\RequestHandler\RequestHandle;
use Illuminate\Foundation\Http\FormRequest;

class ApiLoginRequest extends RequestHandle
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'email.required' => __('auth.email_required'),
            'email.email' => __('auth.email_invalid'),
            'password.required' => __('auth.password_required'),
        ];
    }
}
