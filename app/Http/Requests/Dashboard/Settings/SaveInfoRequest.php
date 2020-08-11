<?php

namespace App\Http\Requests\Dashboard\Settings;

use App\Http\Requests\Dashboard\BaseRequest;

class SaveInfoRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'name'                      => 'required|string|max:255',
            'old_password'              => 'required|string|max:255',
            'password'                  => 'required|string|max:255',
            'confirm_password'          => 'required|same:password'
        ];
    }

    public function messages() : array
    {
        return [
            'name.required'                     => 'Необходимо ввести название компании.',
            'name.string'                       => 'Название компании должно быть строкой.',
            'name.max'                          => 'Название компании не должно превышать 255 символов.',
            'old_password.required'             => 'Необходимо ввести старый пароль.',
            'old_password.string'               => 'Старый пароль должен быть строкой.',
            'old_password.max'                  => 'Старый пароль не должен превышать 255 символов.',
            'password.required'                 => 'Необходимо ввести новый пароль.',
            'password.string'                   => 'Новый пароль должен быть строкой.',
            'password.max'                      => 'Новый пароль не должен превышать 255 символов.',
            'confirm_password.required'         => 'Необходимо повторить новый пароль.',
            'confirm_password.same'             => 'Новые пароли не совпадают.'
        ];
    }
}