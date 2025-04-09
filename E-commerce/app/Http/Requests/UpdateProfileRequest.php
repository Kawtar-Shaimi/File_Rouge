<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
        $user = User::where('uuid', $this->route('uuid'))->firstOrFail();

        return [
            'name' => 'required|max:60|min:3',
            'email' => "required|email|max:150|min:3|unique:users,email,{$user->id}",
            'phone' => "required|max:20|min:6|unique:users,phone,{$user->id}",
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required.',
            'name.min' => 'Name must be at least 3 characters.',
            'name.max' => 'Name must be at most 60 characters.',

            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'email.min' => 'Email must be at least 3 characters.',
            'email.max' => 'Email must be at most 150 characters.',
            'email.unique' => 'Email already used.',

            'phone.required' => 'Phone is required.',
            'phone.min' => 'Phone must be at least 6 characters.',
            'phone.max' => 'Phone must be at most 20 characters.',
            'phone.unique' => 'Phone already used.',
        ];
    }
}
