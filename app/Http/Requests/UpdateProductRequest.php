<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'required|string|between:3,191',
            'description' => 'required|string|between:10,191',
            'thumbnail' => 'image|mimes:jpg,jpeg,png',
            'status' => 'required|numeric',
            'brand_id' => 'required|numeric|exists:brands,id',
            'category_id' => 'required|numeric|exists:categories,id',
            'tags' => 'required|array|exists:tags,id',
            // 'images' => 'required|array',
            'base_price' => 'required|numeric|min:0.01',
            'sale_price' => 'required|numeric|min:0.01',
            'quantity_on_shelf' => 'required|integer|min:0',
            'quantity_in_warehouse' => 'required|integer|min:0',
            'kt_ecommerce_add_product_options' => 'required|array',
            'kt_ecommerce_add_product_options.variation_name.*' => 'required|string',
            'kt_ecommerce_add_product_options.variation_value.*' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'quantity_on_shelf' => 'Please provide how many products present on shelf.',
            'quantity_in_warehouse' => 'Please provide how many products present in warehouse.',
            'kt_ecommerce_add_product_options' => 'Add atleast one variation to the product.',
        ];
    }
}