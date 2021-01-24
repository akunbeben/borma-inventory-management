<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FoodUpdateRequest extends FormRequest
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
            'product_barcode' => 'required|string|min:8|unique:products,product_barcode,' . $this->id,
            'product_plu' => 'required|string|min:7|unique:products,product_plu,' . $this->id,
            'product_expired_date' => 'required|date',
            'min' => 'required|numeric',
            'max' => 'required|numeric',
            'product_supplier' => 'required|string',
            'product_package' => 'required|string',
        ];
    }
}
