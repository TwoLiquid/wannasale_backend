<?php

namespace App\Http\Requests\Dashboard\Currency;

use App\Http\Requests\Dashboard\BaseRequest;

class CreateRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'name' => 'required|string',
            'code' => 'required|string',
        ];
    }

    public function messages() : array
    {
        return [
            'name.required' => 'Необходимо ввести название валюты.',
            'code.required' => 'Необходимо ввести код валюты.'
        ];
    }
}