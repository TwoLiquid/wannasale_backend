<?php

namespace App\Http\Requests\Dashboard\Site;

use App\Http\Requests\Dashboard\BaseRequest;

class CreateRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'name'   => 'required|string|max:255',
            'url'   => [
                'required',
                'regex:/^http:\/\/|(www\.)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/'],
            // 'urls'   => 'required|array',
            // 'urls.*' => 'string',
        ];
    }

    public function messages() : array
    {
        return [
            'name.required' => 'Необходимо ввести название сайта.',
            'name.string'   => 'Название сайта должно быть строкой.',
            'name.max'      => 'Название сайта не должно превышать 255 символов.',
            'url.required' => 'Необходимо указать домены cайта.',
            'url.regex'    => 'Введите корректный домен.',
            // 'urls.array'    => 'Домены сайта должны быть массивом.',
            // 'urls.*.string' => 'Каждый домен сайта должен быть строкой.'
        ];
    }
}
