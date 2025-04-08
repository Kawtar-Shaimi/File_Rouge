<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'shipping_name' => 'required|string|max:60|min:3',
            'shipping_email' => 'required|email|max:150|min:3',
            'shipping_phone' => 'required|string|max:20|min:6',
            'shipping_address' => 'required|string|min:3',
            'shipping_country' => 'required|string|max:100|min:3',
            'shipping_city' => 'required|string|max:100|min:3',
            'shipping_postal_code' => 'required|string|max:20|min:3',
            'payment_method' => 'required|in:credit_card,paypal,cash_on_delivery',
        ];
    }

    public function messages(): array
    {
        return [
            'shipping_name.required' => 'The shipping name field is required.',
            'shipping_name.string' => 'The shipping name must be a string.',
            'shipping_name.max' => 'The shipping name must not be greater than 60 characters.',
            'shipping_name.min' => 'The shipping name must be at least 3 characters.',

            'shipping_email.required' => 'The shipping email field is required.',
            'shipping_email.email' => 'The shipping email must be a valid email address.',
            'shipping_email.max' => 'The shipping email must not be greater than 150 characters.',
            'shipping_email.min' => 'The shipping email must be at least 3 characters.',

            'shipping_phone.required' => 'The shipping phone field is required.',
            'shipping_phone.string' => 'The shipping phone must be a string.',
            'shipping_phone.max' => 'The shipping phone must not be greater than 20 characters.',
            'shipping_phone.min' => 'The shipping phone must be at least 6 characters.',

            'shipping_address.required' => 'The shipping address field is required.',
            'shipping_address.string' => 'The shipping address must be a string.',
            'shipping_address.min' => 'The shipping address must be at least 3 characters.',

            'shipping_country.required' => 'The shipping country field is required.',
            'shipping_country.string' => 'The shipping country must be a string.',
            'shipping_country.max' => 'The shipping country must not be greater than 100 characters.',            
            'shipping_country.min' => 'The shipping country must be at least 3 characters.',

            'shipping_city.required' => 'The shipping city field is required.',
            'shipping_city.string' => 'The shipping city must be a string.',
            'shipping_city.max' => 'The shipping city must not be greater than 100 characters.',
            'shipping_city.min' => 'The shipping city must be at least 3 characters.',

            'shipping_postal_code.required' => 'The shipping postal code field is required.',
            'shipping_postal_code.string' => 'The shipping postal code must be a string.',
            'shipping_postal_code.max' => 'The shipping postal code must not be greater than 20 characters.',
            'shipping_postal_code.min' => 'The shipping postal code must be at least 3 characters.',

            'payment_method.required' => 'The payment method field is required.',
            'payment_method.in' => 'The payment method must be one of the following: Credit Card, PaypPl, Cash on Delivery.',
        ];
    }
}
