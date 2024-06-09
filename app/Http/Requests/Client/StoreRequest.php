<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidEmailDomain;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'string|required|max:255',
            'dni' => ['required', 'string', 'unique:clients', 'regex:/^\d{8}[A-Z]$/'],
            'cif' => ['nullable', 'string', 'unique:clients', 'regex:/^[ABCDEFGHJKLMNPQRSUVW]\d{7}[0-9A-J]$/'],
            'address' => 'string|nullable|max:255',
            'phone' => 'string|nullable|unique:clients|max:9',
            'email' => ['string', 'nullable', 'unique:clients', 'max:255', 'email:rfc,dns', new ValidEmailDomain()]
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
            'dni.regex' => 'El DNI debe tener 8 dígitos seguidos de una letra y la letra debe ser mayúscula.',

            'cif.string' => 'El valor no es correcto.',
            'cif.unique' => 'Este CIF ya se encuentra registrado.',
            'cif.regex' => 'El CIF debe tener una letra inicial, seguida de 7 dígitos y un dígito de control (que puede ser un número o una letra).',

            'address.string' => 'El valor no es correcto.',
            'address.max' => 'Solo se permiten 255 caracteres.',

            'phone.unique' => 'Este número de teléfono ya se encuentra registrado.',
            'phone.string' => 'El valor no es correcto.',
            'phone.max' => 'Solo se permiten 9 caracteres.',

            'email.unique' => 'La dirección de correo electrónico ya se encuentra registrada.',
            'email.string' => 'El valor no es correcto.',
            'email.max' => 'Solo se permiten 255 caracteres.',
            'email.email' => 'No es un correo electrónico.',
            'email.ValidEmailDomain' => 'El dominio del correo electrónico no es válido. Por favor, use uno de los siguientes dominios: gmail.com, yahoo.com, outlook.com, hotmail.com.',
        ];
    }
}
