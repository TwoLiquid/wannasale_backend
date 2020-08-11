<?php

namespace App\Http\Requests\Dashboard\Request\Message;

use App\Http\Requests\Dashboard\BaseRequest;

class SetPriceRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'offered_price' => 'required|integer',
            'message_id'    => 'required|string|exists:requests_messages,id'
        ];
    }

    public function messages() : array
    {
        return [
            'offered_price.required'    => 'Необходимо ввести предлагаемую цену.',
            'offered_price.string'      => 'Предлагаемая цена должна быть числом.',
            'message_id.required'       => 'Необходим ID сообщения.',
            'message_id.string'         => 'ID сообщения должен быть строкой.',
            'message_id.exists'         => 'Сообщение с таким ID не найдено.'
        ];
    }
}
