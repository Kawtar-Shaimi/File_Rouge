<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|max:60|min:3',
            'email' => 'required|email|unique:users,email|max:150|min:3',
            'phone' => 'required|unique:users,phone|max:20|min:3',
            'password' => 'required|confirmed|min:8|max:20|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/',
            'role' => 'required|string|in:admin,publisher'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.max' => 'The name field must not exceed 60 characters.',
            'name.min' => 'The name field must be at least 3 characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email field must be a valid email address.',
            'email.unique' => 'The email field must be unique.',
            'email.max' => 'The email field must not exceed 150 characters.',
            'email.min' => 'The email field must be at least 3 characters.',
            'phone.required' => 'The phone field is required.',
            'phone.unique' => 'The phone field must be unique.',
            'phone.max' => 'The phone field must not exceed 20 characters.',
            'phone.min' => 'The phone field must be at least 3 characters.',
            'password.required' => 'The password field is required.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password.min' => 'The password field must be at least 8 characters.',
            'password.max' => 'The password field must not exceed 20 characters.',
            'password.regex' => 'The password field must contain at least one lowercase letter, one uppercase letter, one digit, and one special character.',
            'role.required' => 'The role field is required.',
            'role.string' => 'The role field must be a string.',
            'role.in' => 'The role field must be either "admin" or "publisher".',
        ];
    }
}
