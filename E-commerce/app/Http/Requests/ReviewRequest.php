<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'rate' => 'required|numeric',
            'content' => 'required|min:3'
        ];
    }

    public function messages(): array
    {
        return [
            'rate.required' => 'Rate is required.',
            'rate.numeric' => 'Rate must be a number.',
            'content.required' => 'Content is required.',
            'content.min' => 'Content must be at least 3 characters.'
        ];
    }
}
