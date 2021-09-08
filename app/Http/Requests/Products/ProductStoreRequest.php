<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'sku' => ['required', 'string'],
            'quantity' => ['required', 'integer', 'min:0']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatorio',
            'name.string' => 'O campo nome deve ser um texto',
            'sku.required' => 'O campo sku é obrigatorio',
            'sku.string' => 'O campo sku deve ser um texto',            
            'quantity.integer' => 'O campo quantidade deve ser um inteiro',
            'quantity.required' => 'O campo quantidade é obrigatorio',
            'quantity.min' => 'O campo quantidade deve ser maior ou igual a 0',
        ];
    }
}
