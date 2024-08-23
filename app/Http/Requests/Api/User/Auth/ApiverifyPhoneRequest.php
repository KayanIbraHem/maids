<?php

namespace App\Http\Requests\Api\User\Auth;

use App\Bases\FormRequest\FormRequestBase;
use Symfony\Component\HttpFoundation\RequestStack;

class ApiverifyPhoneRequest extends FormRequestBase
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
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => __('auth.phone_required'),
        ];
    }
}
