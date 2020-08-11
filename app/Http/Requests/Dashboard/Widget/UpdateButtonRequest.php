<?php

namespace App\Http\Requests\Dashboard\Widget;

use App\Http\Requests\Dashboard\BaseRequest;

class UpdateButtonRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'display_settings.button_text'              => 'string',
            'display_settings.button_color'             => 'string',
            'display_settings.button_text_color'        => 'string',
        ];
    }

    public function messages() : array
    {
        return [
            'display_settings.button_text.string'          => 'Содержания текста кнопки виджета должно быть текстом.',
            'display_settings.button_color.string'         => 'HEX цвет кнопки виджета должен быть строкой.',
            'display_settings.button_text_color.string'    => 'HEX цвет текста кнопки виджета должен быть строкой.'
        ];
    }
}
