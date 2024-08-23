<?php

namespace App\Http\Requests\Api\User\Auth;

use App\Bases\FormRequest\FormRequestBase;
use Illuminate\Foundation\Http\FormRequest;

class ApiResetPasswordRequest extends FormRequestBase
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
            'phone' => 'required',
            'password' => 'required|confirmed|min:8|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'password.required' => __('auth.password_required'),
            'password.min' => __('auth.password_min'),
            'password.max' => __('auth.password_max'),
            'password.confirmed' => __('auth.password_confirmed'),
            'phone.required' => __('auth.phone_required'),
            'phone.unique' => __('auth.phone_unique'),
        ];
    }
}
