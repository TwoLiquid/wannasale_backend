<?php

namespace App\Http\Requests\Dashboard\Card;

use App\Http\Requests\Dashboard\BaseRequest;

class AttachRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'cryptogram'    => 'required|string',
        ];
    }

    public function messages() : array
    {
        return [
            'cryptogram.required'   => 'Криптограмма не найдена.',
            'cryptogram.string'     => 'Криптограмма должна быть строкой.'
        ];
    }
}