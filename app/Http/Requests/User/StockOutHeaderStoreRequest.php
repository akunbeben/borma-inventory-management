<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StockOutHeaderStoreRequest extends FormRequest
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
            'stock_out_type' => 'required|numeric',
            'order_id' => 'required|string'
        ];
    }
}
