<?php

namespace App\Http\Requests\Dashboard\Request;

use App\Http\Requests\Dashboard\BaseRequest;

class CreateRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'widget_id'         => 'required|string|exists:widgets,id',
            'site_id'           => 'required|string|exists:sites,id',
            'item_id'           => 'required|string|exists:items,id',
            'client_id'         => 'required|string|exists:clients,id',
            'name'              => 'required|string',
            'item_name'         => 'nullable|required|string',
            'email'             => 'required|email',
            'phone'             => 'required|string',
            'country'           => 'nullable|required|string',
            'city'              => 'nullable|required|string',
            'offered_price'     => 'required|integer',
        ];
    }

    public function messages() : array
    {
        return [
            'widget_id.required'            => 'Необходимо выбрать виджет.',
            'widget_id.string'              => 'ID виджета должен быть строкой.',
            'widget_id.exists'              => 'Виджет с таким ID не найден.',
            'site_id.required'              => 'Необходимо выбрать сайт.',
            'site_id.string'                => 'ID сайта должен быть строкой.',
            'site_id.exists'                => 'Сайт с таким ID не найден.',
            'item_id.required'              => 'Необходимо выбрать товар.',
            'item_id.string'                => 'ID товара должен быть строкой.',
            'item_id.exists'                => 'Товар с таким ID не найден.',
            'client_id.required'            => 'Необходимо выбрать клиента.',
            'client_id.string'              => 'ID клиента должен быть строкой.',
            'client_id.exists'              => 'Клиент с таким ID не найден.',
            'name.required'                 => 'Необходимо ввести название товара.',
            'name.string'                   => 'Название товаара должно быть строкой.',
            'item_name.required'            => 'Необходимо ввести свободное название товара.',
            'item_name.string'              => 'Свободное название товаара должно быть строкой.',
            'email.required'                => 'Необходимо ввести e-mail.',
            'email.email'                   => 'Неверный формат e-mail.',
            'phone.required'                => 'Необходимо ввести номер телефона.',
            'phone.string'                  => 'Неверный формат номера телефона.',
            'country.required'              => 'Необходимо ввести страну.',
            'country.string'                => 'Страна должна быть строкой.',
            'city.required'                 => 'Необходимо ввести город.',
            'city.string'                   => 'Город должен быть строкой.',
            'offered_price.required'        => 'Необходимо ввести предлагаемую цену.',
            'offered_price.string'          => 'Предлагаемая цена должна быть числом.'
        ];
    }
}
