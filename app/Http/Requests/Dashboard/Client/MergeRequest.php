<?php

namespace App\Http\Requests\Dashboard\Client;

use App\Http\Requests\Dashboard\BaseRequest;

class MergeRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'name'       => 'string|nullable',
            'phone'      => 'string|nullable',
            'clients'    => 'required|array',
            'clients.*'  => 'exists:clients,id',
        ];
    }

    public function messages() : array
    {
        return [
            'name.required'    => 'Необходимо ввести имя клиента.',
            'name.string'      => 'Имя клиента должно быть строкой.',
            'phone.required'   => 'Необходимо ввести телефон клиента.',
            'phone.string'     => 'Телефон клиента должно быть строкой.',
            'clients.required' => 'Необходим массив ID клиентов.',
            'clients.array'    => 'ID клиентов должны быть массивом.',
            'clients.*.exists' => 'Нет клиента с таким ID.'
        ];
    }
}