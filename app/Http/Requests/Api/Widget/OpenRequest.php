<?php

namespace App\Http\Requests\Api\Widget;

use App\Http\Requests\Api\BaseRequest;

class OpenRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'session_key'  => 'required|string|max:16'
        ];
    }

    public function messages() : array
    {
        return [
            'session_key.required'          => 'Необходим ключ сессии виджета.',
            'session_key.string'            => 'Ключ сессии виджета должен быть строкой.',
            'session_key.max'               => 'Максимальное количество символов в ключе виджета - 16.'
        ];
    }
}