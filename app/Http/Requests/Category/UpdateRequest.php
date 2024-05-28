<?php

namespace App\Http\Requests\Category;

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
    public function rules()
    {
        return [
            'name' => 'required|string|max:50|unique:categories,name,' . $this->route('category')->id,
            'description' => 'nullable|string|max:255',
        ];
    }

    public function messages(){
        return[
            'name.required' => 'Este campo es requerido.',
            'name.string' => 'El valor no es correcto.',
            'name.max' => 'Solo se permiten 50 caracteres.',
            'name.unique' => 'El nombre de la categoría ya está en uso.',
            'description.string' => 'El valor no es correcto.',
            
        ];
    }
   

   
}
