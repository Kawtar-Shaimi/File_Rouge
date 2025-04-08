<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => 'required|min:8|max:20',
            'new_password' => 'required|confirmed|min:8|max:20|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/'
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => 'Old password is required.',
            'old_password.min' => 'Old password must be at least 8 characters.',
            'old_password.max' => 'Old password must not exceed 20 characters.',
            'new_password.required' => 'New password is required.',
            'new_password.min' => 'New password must be at least 8 characters.',
            'new_password.max' => 'New password must not exceed 20 characters.',
            'new_password.regex' => 'New password must contain at least one lowercase letter, one uppercase letter, one digit, and one special character.',
            'new_password.confirmed' => 'New password and confirmed password do not match.',
        ];
    }
}
