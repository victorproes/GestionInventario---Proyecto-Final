<?php

namespace App\Http\Requests\Client;

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
            'name' => 'string|required|max:255',
            'dni' => 'string|required|unique:clients,dni,'.$this->route('client')->id.'|max:8',
            'cif' => 'string|required|unique:clients,cif,'.$this->route('client')->id.'|max:9',
            'address' => 'string|required|max:255',
            'phone' => 'string|required|unique:clients,phone,'.$this->route('client')->id.'|max:9',
            'email' => 'string|required|unique:clients,email,'.$this->route('client')->id.'|max:255|email:rfc,dns'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Este campo es requerido.',
            'name.string' => 'El valor no es correcto.',
            'name.max' => 'Solo se permiten 255 caracteres.',

            'dni.required' => 'Este campo es requerido.',
            'dni.string' => 'El valor no es correcto.',
            'dni.unique' => 'Este DNI ya se encuentra registrado.',
            'dni.min' => 'Se requiere de 8 caracteres.',
            'dni.max' => 'Solo se permiten 8 caracteres.',

            'cif.unique' => 'Este cif ya se encuentra registrado.',
            'cif.string' => 'El valor no es correcto.',
            'cif.max' => 'Solo se permiten 9 caracteres.',
            'cif.min' => 'Se requiere de 9 caracteres.',

            'address.string' => 'El valor no es correcto.',
            'address.max' => 'Solo se permiten 255 caracteres.',

            'phone.unique' => 'Este numero de telefono ya se encuentra registrado.',
            'phone.string' => 'El valor no es correcto.',
            'phone.max' => 'Solo se permiten 9 caracteres.',
            'phone.min' => 'Se requiere de 9 caracteres.',

            'email.unique' => 'La dirección de correo electrónico ya se encuentra registrada',
            'email.string' => 'El valor no es correcto.',
            'email.max' => 'Solo se permiten 255 caracteres.',
            'email.email' => 'No es un correo electrónico.',



        ];
    }
}
