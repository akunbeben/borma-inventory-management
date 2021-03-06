<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FoodStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_name' => 'required|string',
            'product_barcode' => 'required|string|min:8|unique:products,product_barcode',
            'product_plu' => 'required|string|min:7|unique:products,product_plu',
            'product_initial_quantity' => 'numeric',
            'min' => 'required|numeric',
            'max' => 'required|numeric',
            'product_expired_date' => 'required|date',
            'product_supplier' => 'required|string',
            'product_package' => 'required|string',
        ];
    }
}
