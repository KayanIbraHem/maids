<?php

namespace App\Http\Requests\Dashboard\Admin\Auth;

use App\Bases\FormRequest\FormRequestBase;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequestBase
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
            'old_password' => 'required',
            'new_password' => 'required|min:8',
        ];
    }
    public function messages(): array
    {
        return [
            'old_password.required' => __('auth.password_required'),
            'new_password.required' => __('auth.password_required'),
            'new_password.min' => __('auth.password_min'),
        ];
    }
}
