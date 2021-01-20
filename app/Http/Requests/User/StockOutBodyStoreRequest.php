<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StockOutBodyStoreRequest extends FormRequest
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
            'header_id' => 'required',
            'product_id' => 'required|string',
            'quantity' => 'required|numeric',
            'information' => 'required|string',
        ];
    }
}
