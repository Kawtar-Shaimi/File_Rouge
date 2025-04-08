<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'role' => 'required|string|in:admin,publisher,client'
        ];
    }

    public function messages(): array
    {
        return [
            'role.required' => 'User role is required.',
            'role.string' => 'User role must be a string.',
            'role.in' => 'User role must be admin, publisher or client.'
        ];
    }
}
