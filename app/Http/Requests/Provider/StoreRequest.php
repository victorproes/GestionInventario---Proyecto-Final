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
            'cif' => ['required', 'string', 'regex:/^[ABCDEFGHJKLMNPQRSUVW]\d{7}[0-9A-J]$/', 'unique:providers'],
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
            'cif.regex' => 'El CIF debe tener una letra inicial, seguida de 7 dígitos y un dígito de control (que puede ser un número o una letra).',
            'cif.unique' => 'Ya se encuentra registrado.',

            'address.max' => 'Solo se permiten 255 caracteres.',
            'address.string' => 'El valor no es correcto.',

            'phone.required' => 'Este campo es requerido.',
            'phone.regex' => 'El teléfono debe contener 9 numeros',
            'phone.unique' => 'Ya se encuentra registrado.',




        ];
    }
}
