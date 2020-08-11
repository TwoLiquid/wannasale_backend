<?php

namespace App\Http\Requests\Dashboard\Widget;

use App\Http\Requests\Dashboard\BaseRequest;

class UpdateSettingsRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'enabled'                            => 'boolean',
            'on_item_page_only'                  => 'boolean',
            'display_settings.show_phone'        => 'boolean'
        ];
    }

    public function messages() : array
    {
        return [
            'enabled.boolean'                       => 'Данные об активации должны быть булевыми.',
            'on_item_page_only.boolean'             => 'Данные о флаге страницы товара должны быть булевыми.',
            'display_settings.show_phone.boolean'   => 'Данные о флаге отображения поля для ввода номера телефона должны быть булевыми.'
        ];
    }
}
