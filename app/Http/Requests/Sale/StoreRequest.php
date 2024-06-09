<?php

namespace App\Http\Requests\Sale;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'client_id' => 'required|exists:clients,id',
            'product_id.*' => 'required|exists:products,id',
            'quantity.*' => 'required|numeric|min:1',
            'price.*' => 'required|numeric|min:0',
            'discount.*' => 'nullable|numeric|min:0|max:100',
            'iva' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'client_id.required' => 'El campo cliente es obligatorio.',
            'product_id.*.required' => 'El campo producto es obligatorio.',
            'quantity.*.required' => 'El campo cantidad es obligatorio.',
            'quantity.*.numeric' => 'La cantidad debe ser un número.',
            'quantity.*.min' => 'La cantidad debe ser al menos 1.',
            'price.*.required' => 'El campo precio es obligatorio.',
            'price.*.numeric' => 'El precio debe ser un número.',
            'price.*.min' => 'El precio debe ser al menos 0.',
            'discount.*.numeric' => 'El descuento debe ser un número.',
            'discount.*.min' => 'El descuento debe ser al menos 0.',
            'discount.*.max' => 'El descuento no puede ser mayor a 100.',
            'iva.required' => 'El campo IVA es obligatorio.',
            'iva.numeric' => 'El IVA debe ser un número.',
            'iva.min' => 'El IVA debe ser al menos 0.',
        ];
    }
}
