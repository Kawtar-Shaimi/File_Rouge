<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required|string|max:100|min:3',
            'description' => 'required|string|min:3',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Category name is required.',
            'name.string' => 'Category name must be a string.',
            'name.max' => 'Category name must be less than 100 characters.',
            'name.min' => 'Category name must be at least 3 characters.',
            'description.required' => 'Category description is required.',
            'description.string' => 'Category description must be a string.',
            'description.min' => 'Category description must be at least 3 characters.',
        ];
    }
}
