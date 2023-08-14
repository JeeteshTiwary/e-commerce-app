<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'product_name' => 'required|string|max:191',
            'description' => 'required|string|max:191',
            'base_price' => 'required|numeric|min:0.01',
            'sell_price' => 'required|numeric|min:0.01',
            'thumbnail' => 'required|image|mimes:png,jpg,jpeg',
            'shelf' => 'required|integer|min:0',
            'warehouse' => 'required|integer|min:0',
            'product_option' => 'required|string|max:191',
            'product_option_value' => 'required|string|max:191',
            'tags' => 'array',
        ];
    }

    public function messages(): array
    {
        return [
            'shelf' => 'Please provide how many products present in shelf',
            'warehouse' => 'required|integer|min:0',
            'product_option' => 'Product variation is required.',
            'product_option_value' => 'Please provide value for the variation.',
        ];
    }
}