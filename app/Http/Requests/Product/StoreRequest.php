<?php

namespace App\Http\Requests\Product;

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
            'name' => 'string|required|unique:products|max:255',
            'sell_price' => 'required|numeric',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Este campo es requerido.',
            'name.string' => 'El valor no es correcto.',
            'name.max' => 'Solo se permiten 255 caracteres.',
            'name.unique' => 'El nombre del producto ya existe.',
            'sell_price.required' => 'Este campo es requerido.',
            'sell_price.numeric' => 'El valor debe ser un número.',
            'picture.image' => 'El archivo debe ser una imagen.',
            'picture.mimes' => 'La imagen debe ser un archivo de tipo: jpeg, png, jpg, gif.',
            'picture.max' => 'El tamaño de la imagen no debe exceder los 2048 KB.',

          
            


        ];
    }
}
