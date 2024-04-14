<?php

namespace App\Http\Requests\Provider;

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
            'name'=>'required|string|max:255',
            'email'=>'required|email|string|max:255|unique:providers',
            'cif'=>'required|string|max:9|min:9|unique:providers',
            'address'=>'nullable|string|max:255',
            'phone'=>'required|string|max:9|min:9|unique:providers',
        ];
    }

    public function messages(){
        return[
            'name.required'=>'Este campo es requerido.',
            'name.string'=>'El valor no es correcto.',
            'name.max'=>'Solo se permiten 255 caracteres.',

            'email.required'=>'Este campo es requerido.',
            'email.string'=>'El valor no es correcto.',
            'email.max'=>'Solo se permiten 255 caracteres.',
            'email.email'=>'No es un correo electrónico.',
            'email.unique'=>'Ya se encuentra registrado.',

            'cif.required'=>'Este campo es requerido.',
            'cif.string'=>'El valor no es correcto.',
            'cif.max'=>'Solo se permiten 9 caracteres.',
            'cif.min'=>'Se requiere de 9 caracteres.',
            'cif.unique'=>'Ya se encuentra registrado.',

            'address.max'=>'Solo se permiten 255 caracteres.',
            'address.string'=>'El valor no es correcto.',

            'phone.required'=>'Este campo es requerido.',
            'phone.string'=>'El valor no es correcto.',
            'phone.max'=>'Solo se permiten 9 caracteres.',
            'phone.min'=>'Se requiere de 9 caracteres.',
            'phone.unique'=>'Ya se encuentra registrado.',
            


            
        ];
    }
}
