<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|min:3|max:60',
            'email' => 'required|email|min:5|max:150|unique:users,email',
            'phone' => 'required|unique:users,phone|min:5|max:20',
            'role' => 'required|in:client,publisher',
            'password' => 'required|confirmed|min:8|max:20|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+])/',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'name.min' => 'Name must be at least 3 characters',
            'name.max' => 'Name must be at most 60 characters',
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'email.min' => 'Email must be at least 5 characters',
            'email.max' => 'Email must be at most 150 characters',
            'email.unique' => 'Email already exists',
            'phone.required' => 'Phone is required',
            'phone.unique' => 'Phone already exists',
            'phone.min' => 'Phone must be at least 5 characters',
            'phone.max' => 'Phone must be at most 20 characters',
            'role.required' => 'Role is required',
            'role.in' => 'Role must be client or publisher',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'password.max' => 'Password must be at most 20 characters',
            'password.confirmed' => 'Password does not match',
            'password.regex' => 'Password must contain at least one lowercase letter, one uppercase letter, one number, and one special character',
        ];
    }
}
