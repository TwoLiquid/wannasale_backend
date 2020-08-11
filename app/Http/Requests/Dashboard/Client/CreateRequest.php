<?php

namespace App\Http\Requests\Dashboard\Client;

use App\Http\Requests\Dashboard\BaseRequest;

class CreateRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string'
        ];
    }

    public function messages() : array
    {
        return [
            'name.required' => 'Необходимо ввести имя клиента.',
            'email.required' => 'Необходимо ввести E-mail клиента.',
            'phone.required' => 'Необходимо ввести телефон клиента.'
        ];
    }
}