<?php

namespace App\Http\Requests\Dashboard\Settings;

use App\Http\Requests\Dashboard\BaseRequest;

class InviteUserRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'email' => 'required|email'
        ];
    }

    public function messages() : array
    {
        return [
            'email.required' => 'Необходимо ввести E-mail приглашаемого пользователя.',
            'email.email'    => 'Неверный формат адреса почты приглашаемого пользователя.'
        ];
    }
}