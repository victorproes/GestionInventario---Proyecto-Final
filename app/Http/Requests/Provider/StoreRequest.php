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
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255|unique:providers',
            'cif' => ['required', 'string', 'regex:/^[A-Za-z0-9]{1}[0-9]{7}[A-Za-z0-9]{1}$/', 'unique:providers'],
            'address' => 'nullable|string|max:255',
            'phone' => ['required', 'regex:/^[679]{1}[0-9]{8}$/', 'unique:providers'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Este campo es requerido.',
            'name.string' => 'El valor no es correcto.',
            'name.max' => 'Solo se permiten 255 caracteres.',

            'email.required' => 'Este campo es requerido.',
            'email.string' => 'El valor no es correcto.',
            'email.max' => 'Solo se permiten 255 caracteres.',
            'email.email' => 'No es un correo electrónico.',
            'email.unique' => 'Ya se encuentra registrado.',

            'cif.required' => 'Este campo es requerido.',
            'cif.string' => 'El valor no es correcto.',
            'cif.regex' => 'El CIF no tiene un formato válido.',
            'cif.unique' => 'Ya se encuentra registrado.',

            'address.max' => 'Solo se permiten 255 caracteres.',
            'address.string' => 'El valor no es correcto.',

            'phone.required' => 'Este campo es requerido.',
            'phone.regex' => 'El teléfono no tiene un formato válido.',
            'phone.unique' => 'Ya se encuentra registrado.',




        ];
    }
}
