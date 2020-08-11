<?php

namespace App\Http\Requests\Dashboard\Item;

use App\Http\Requests\Dashboard\BaseRequest;

class CreateRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'name'                      => 'required|string|max:255',
            'code'                      => 'string|max:255',
            'initial_price'             => 'required|integer',
            'min_acceptable_price'      => 'required|integer',
            'min_unacceptable_price'    => 'required|integer',
            'urls'                      => 'required|array',
            'urls.*'                    => 'string',
        ];
    }

    public function messages() : array
    {
        return [
            'name.required'                     => 'Необходимо ввести название товара.',
            'name.string'                       => 'Название товара должно быть строкой.',
            'name.max'                          => 'Название товара не должно превышать 255 символов.',
            'code.string'                       => 'Артикул товара должен быть строкой.',
            'code.max'                          => 'Артикул товара не должен превышать 255 символов.',
            'initial_price.required'            => 'Необходимо ввести исходную цену.',
            'initial_price.integer'             => 'Исходная цена должна быть числом.',
            'min_acceptable_price.required'     => 'Введите минимальную допустимую цену.',
            'min_acceptable_price.integer'      => 'Минимальная допустимая цена должна быть числом.',
            'min_unacceptable_price.required'   => 'Введите минимальную недопустимую цену.',
            'min_unacceptable_price.integer'    => 'Минимальная недопустимая цена должна быть числом.',
            'urls.required'                     => 'Необходимо ввести URL-ы товара.',
            'urls.array'                        => 'URL-ы товара должны быть массивом.',
            'urls.*.string'                     => 'Каждый URL товара должен быть строкой.'
        ];
    }
}