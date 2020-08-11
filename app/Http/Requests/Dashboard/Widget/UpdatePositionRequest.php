<?php

namespace App\Http\Requests\Dashboard\Widget;

use App\Http\Requests\Dashboard\BaseRequest;

class UpdatePositionRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'display_settings.position'          => 'integer',
            'display_settings.bottom'            => 'integer',
            'display_settings.side'              => 'integer'
        ];
    }

    public function messages() : array
    {
        return [
            'display_settings.position.integer'     => 'ID положения виджета на экране должен быть числом.',
            'display_settings.side.integer'         => 'Отступ от боковой части экрана должен быть числом.',
            'display_settings.bottom.integer'       => 'Отступ от Нижней части экрана должен быть числом.'
        ];
    }
}
