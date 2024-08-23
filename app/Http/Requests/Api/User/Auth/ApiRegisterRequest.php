<?php

namespace App\Http\Requests\Api\User\Auth;

use App\Bases\FormRequest\FormRequestBase;

class ApiRegisterRequest extends FormRequestBase
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
            'name' => 'required|min:4|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8|max:255',
            'phone' => 'nullable|unique:users,phone',
            'country_code' => ['required', 'numeric', 'regex:/^\+\d{1,3}$/'],
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => __('auth.name_required'),
            'name.min' => __('auth.name_min'),
            'name.max' => __('auth.name_max'),
            'email.required' => __('auth.email_required'),
            'email.email' => __('auth.email_invalid'),
            'email.unique' => __('auth.email_unique'),
            'password.required' => __('auth.password_required'),
            'password.min' => __('auth.password_min'),
            'password.max' => __('auth.password_max'),
            'password.confirmed' => __('auth.password_confirmed'),
            'phone.required' => __('auth.phone_required'),
            'phone.unique' => __('auth.phone_unique'),
            'country_code.required' => __('auth.country_code_required'),
            'country_code.numeric' => __('auth.country_code_numeric'),
            'country_code.regex' => __('auth.country_code_regex'),
            'image.image' => __('auth.image_invalid'),
            'image.mimes' => __('auth.image_mimes'),
        ];
    }
}
