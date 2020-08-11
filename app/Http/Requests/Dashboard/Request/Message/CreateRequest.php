<?php

namespace App\Http\Requests\Dashboard\Request\Message;

use App\Http\Requests\Dashboard\BaseRequest;

class CreateRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'title'         => 'required|string|max:255',
            'text'          => 'required|string',
            'offered_price' => 'nullable|required|integer'
        ];
    }

    public function messages() : array
    {
        return [
            'name.required'             => 'Необходимо ввести заголовок сообщения.',
            'name.string'               => 'Заголовок сообщения должен быть строкой.',
            'name.max'                  => 'Заголовок сообщения не должен превышать 255 символов.',
            'text.required'             => 'Необходимо ввести текст сообщения.',
            'text.string'               => 'Текст сообщения должен быть строкой.',
            'offered_price.required'    => 'Необходимо ввести предлагаемую цену.',
            'offered_price.string'      => 'Предлагаемая цена должна быть числом.'
        ];
    }
}
