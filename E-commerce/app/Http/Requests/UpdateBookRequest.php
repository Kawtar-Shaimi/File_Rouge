<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'name' => 'required|string|max:150|min:3',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,uuid',
            'stock' => 'required|numeric',
            'description' => 'required|string|min:3',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must be less than 150 characters',
            'name.min' => 'Name must be at least 3 characters',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be a number',
            'category_id.required' => 'Category is required',
            'category_id.exists' => 'Category does not exist',
            'stock.required' => 'Stock is required',
            'stock.numeric' => 'Stock must be a number',
            'description.required' => 'Description is required',
            'description.string' => 'Description must be a string',
            'description.min' => 'Description must be at least 3 characters',
            'image.image' => 'The uploaded file must be an image',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg',
            'image.max' => 'The image may not be greater than 5048 kilobytes',
        ];
    }
}
