<?php

namespace App\Http\Requests\Dashboard\Widget;

use App\Http\Requests\Dashboard\BaseRequest;

class UpdateWindowRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'display_settings.title_text'           => 'string',
            'display_settings.title_color'          => 'string',
            'display_settings.text'                 => 'nullable|string',
            'display_settings.background_color'     => 'string'
        ];
    }

    public function messages() : array
    {
        return [
            'display_settings.title_text.string'             => 'Текст заголовка виджета должен быть строкой.',
            'display_settings.title_color.string'            => 'HEX цвет заголовка виджета должен быть строкой.',
            'display_settings.text.string'                   => 'Уникальный текст виджета должен быть строкой.',
            'display_settings.background_color.string'       => 'HEX цвет заднего фона виджета должен быть строкой.'
        ];
    }
}
