<?php

namespace App\Http\Requests\Api\Widget;

use App\Http\Requests\Api\BaseRequest;
use Illuminate\Validation\Rule;

class CookiesInsertRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|phone:RU',
        ];
    }

    public function messages() : array
    {
        return [
            'name.required'          => 'Необходимо ввести имя.',
            'name.string'            => 'Имя должно быть строкой.',
            'name.max'               => 'Имя должно содержать не более 255 символов.',
            'email.required'         => 'Необходимо ввести email.',
            'email.email'            => 'Неферный формат адреса электронной почты.',
            'email.max'              => 'Длина адреса почты не должна превышать 255 символов',
            'phone.required'         => 'Необходимо ввести номер телефона.',
            'phone.phone'            => '!&@^%!@*&^%!#*&^.',
        ];
    }
}