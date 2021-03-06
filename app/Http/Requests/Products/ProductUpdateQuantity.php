<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateQuantity extends FormRequest
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
            'quantity' => ['required', 'integer']
        ];
    }

    public function messages()
    {
        return [
            'quantity.integer' => 'O campo quantidade deve ser um inteiro',
            'quantity.required' => 'O campo quantidade é obrigatorio',
        ];
    }
}
