<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'status' => 'required|string|in:pending,paid,failed'
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Status is required',
            'status.string' => 'Status must be a string',
            'status.in' => 'Status must be one of the following: Pending, Paid, Failed'
        ];
    }
}
