<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name'=>'string|required|unique:products,name,'.$this->route('provider')->id.'|max:255',

            'cif'=>'required|string|min:9|unique:providers,cif,'.$this->route('provider')->id.'|max:9',
             'image'=>'required|dimensions:min_width=100,min_height=200',
             'sell_price'=>'required',
             'category_id'=>'integer|required|exists:App\Category,id',
             'provider_id'=>'integer|required|exists:App\Provider,id',

            'name'=>'required|string|max:50',
            'description'=>'nullable|string|max:255',
        ];
    }

    public function messages(){
        return[
            'name.required'=>'Este campo es requerido.',
            'name.string'=>'El valor no es correcto.',
            'name.max'=>'Solo se permiten 255 caracteres.',

            'image.required'=>'Este campo es requerido.',
            'image.dimensions'=>'Solo se permiten imágenes de 100x200 px.',

            'sell_price.required'=>'Este campo es requerido',

            'category_id.required'=>'Este campo es requerido.',
            'category_id.integer'=>'El valor tiene que ser entero.',
            'category_id.exists'=>'La categoría no existe.',

            'provider_id.required'=>'Este campo es requerido.',
            'provider_id.integer'=>'El valor tiene que ser entero.',
            'provider_id.exists'=>'El proveedor no existe.',




            
            
        ];
    }
}
