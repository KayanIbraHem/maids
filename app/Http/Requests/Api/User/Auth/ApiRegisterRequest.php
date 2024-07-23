<?php

namespace App\Http\Requests\Api\User\Auth;

use App\Http\RequestHandler\RequestHandle;

class ApiRegisterRequest extends RequestHandle
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
            'first_name' => 'required|min:4|max:255',
            'last_name' => 'required|min:4|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8|max:255',
            'phone' => 'nullable|unique:users,phone',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
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
            'email.required' => __('auth.email_required'),
            'email.email' => __('auth.email_invalid'),
            'email.unique' => __('auth.email_unique'),
            'password.required' => __('auth.password_required'),
            'password.min' => __('auth.password_min'),
            'password.max' => __('auth.password_max'),
            'password.confirmed' => __('auth.password_confirmed'),
            'phone.required' => __('auth.phone_required'),
            'phone.unique' => __('auth.phone_unique'),
            'image.image' => __('auth.image_invalid'),
            'image.mimes' => __('auth.image_mimes'),
        ];
    }
}
