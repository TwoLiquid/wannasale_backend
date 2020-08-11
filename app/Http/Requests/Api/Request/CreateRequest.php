<?php

namespace App\Http\Requests\Api\Request;

use App\Http\Requests\Api\BaseRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends BaseRequest
{
    public function rules() : array
    {
        $widget = auth(GUARD_API)->user();
        $site = $widget->site;

        return [
            'session_key'   => 'required|string|max:16',
            'item_id' => [
                'string',
                Rule::exists('items', 'id')->where(function ($query) use ($site) {
                    $query->where('site_id', $site->id);
                }),
            ],
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'phone'         => 'nullable|phone:AUTO,RU,US',
            'country'       => 'nullable|string|max:2',
            'offered_price' => 'required|integer|min:1',
            'ip_city'       => 'nullable|string',
            'ip_country'    => 'nullable|string',
            'custom_fields' => 'nullable|array'
        ];
    }

    public function messages() : array
    {
        return [
            'session_key.required'      => 'Не найден ключ сессии виджета.',
            'session_key.string'        => 'Ключ виджета должен быть строкой.',
            'session_key.max'           => 'Максимальное количество символов в ключе сессии - 16.',
            'item_id.string'            => 'ID товара должен быть строкой.',
            'item_id.exists'            => 'Товар с таким ID не найден.',
            'name.required'             => 'Необходимо ввести имя.',
            'name.string'               => 'Имя должно быть строкой.',
            'name.max'                  => 'Имя должно содержать не более 255 символов.',
            'email.required'            => 'Необходимо ввести email.',
            'email.email'               => 'Неверный формат адреса электронной почты.',
            'email.max'                 => 'Длина адреса почты не должна превышать 255 символов',
            'phone.required'            => 'Необходимо ввести номер телефона.',
            'country.phone'             => '!&@^%!@*&^%!#*&^.',
            'country.required'          => 'Необходим код города.',
            'country.string'            => 'Код города должен быть строкой.',
            'phone.max'                 => 'Код города долженг содержать не более 2-ух символов.',
            'offered_price.required'    => 'Необходимо ввести предлагаемую цену.',
            'offered_price.integer'     => 'Предлагаемая цена должна быть числом.',
            'offered_price.min'         => 'Предлагаемая цена должна быть больше, чем 0.',
            'ip_city.string'            => 'Город должен быть строкой.',
            'ip_country.string'         => 'Страна должна быть строкой.',
            'custom_fields.array'       => 'Кастомные поля виджета должны быть массивом'
        ];
    }
}