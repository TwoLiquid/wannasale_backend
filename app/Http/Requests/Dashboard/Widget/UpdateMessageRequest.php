<?php

namespace App\Http\Requests\Dashboard\Widget;

use App\Http\Requests\Dashboard\BaseRequest;

class UpdateMessageRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'display_settings.message_text'                => 'string',
            'display_settings.message_text_color'          => 'string',
            'display_settings.message_background_color'    => 'string'
        ];
    }

    public function messages() : array
    {
        return [
            'display_settings.message_text.string'                  => 'Текст заголовка сообщения должен быть строкой.',
            'display_settings.message_text_color.string'            => 'HEX цвет заголовка сообщения должен быть строкой.',
            'display_settings.message_background_color.string'      => 'HEX цвет заднего фона сообщения должен быть строкой.'
        ];
    }
}
