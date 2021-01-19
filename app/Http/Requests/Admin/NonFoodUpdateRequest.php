<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NonFoodUpdateRequest extends FormRequest
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
            'product_plu' => 'required|string|unique:products,product_plu,' . $this->id,
            'product_expired_date' => 'required|date',
            'product_supplier' => 'required|string',
            'product_package' => 'required|string',
        ];
    }
}
