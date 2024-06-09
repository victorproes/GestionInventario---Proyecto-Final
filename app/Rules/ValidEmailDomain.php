<?php

namespace app\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidEmailDomain implements Rule
{
    protected $allowedDomains = ['gmail.com', 'yahoo.com', 'outlook.com', 'hotmail.com'];

    public function passes($attribute, $value)
    {
        $domain = substr(strrchr($value, "@"), 1);
        return in_array($domain, $this->allowedDomains);
    }

    public function message()
    {
        return 'El dominio del correo electrónico no es válido. Por favor, use uno de los siguientes dominios: ' . implode(', ', $this->allowedDomains) . '.';
    }
}
