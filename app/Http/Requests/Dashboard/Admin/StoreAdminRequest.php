<?php

namespace App\Http\Requests\Dashboard\Admin;

use App\Enums\AdminType;
use Illuminate\Validation\Rules\Enum;
use App\Bases\FormRequest\FormRequestBase;
use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequestBase
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
            'email' => 'required|email|max:255|unique:admins,email',
            'password' => 'required|min:8',
            'type' => ['required', new Enum(AdminType::class)],
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('auth.name_required'),
            'name.min' => __('auth.name_min'),
            'name.max' => __('auth.name_max'),
            'email.unique' => __('auth.email_unique'),
            'email.required' => __('auth.email_required'),
            'email.email' => __('auth.email_invalid'),
            'password.required' => __('auth.password_required'),
            'password.min' => __('auth.password_min'),
            'type.required' => __('auth.type_required'),
            'image.mimes' => __('auth.image_mimes'),
            'image.image' => __('auth.image_invalid'),
        ];
    }
}
