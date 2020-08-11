<?php

namespace App\Http\Requests\Front\Auth;

use App\Http\Requests\Dashboard\BaseRequest;

class RegisterRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'user_name'                 => 'required|string|max:255',
            'user_email'                => 'required|email|unique:users,email',
            'user_password'             => 'required|string|max:255',
            'user_confirm_password'     => 'required|same:user_password',
            'company_name'              => 'required|string|max:255',
            'company_slug'              => 'required|string|unique:vendors,slug|regex:/^[a-zA-Z0-9\-]*$/'
        ];
    }

    public function messages() : array
    {
        return [
            'user_name.required'                => 'Необходимо ввести имя пользователя.',
            'user_name.string'                  => 'Имя пользователя должно быть строкой.',
            'user_name.max'                     => 'Максимальное количество допустимых символов в имени полльзователя - 255.',
            'user_email.required'               => 'Необходимо ввести email пользователя.',
            'user_email.email'                  => 'Неверный формат E-mail.',
            'user_email.users'                  => 'Такой email уже используется.',
            'user_password.required'            => 'Необходимо ввести пароль.',
            'user_password.string'              => 'Пароль должен быть строкой.',
            'user_password.max'                 => 'Максимальное количество допустимых символов в пароле - 255.',
            'user_confirm_password.required'    => 'Необходимо повторить пароль.',
            'user_confirm_password.string'      => 'Введенные пароли не совпадают.',
            'company_name.required'             => 'Необходимо ввести имя пользователя.',
            'company_name.string'               => 'Имя пользователя должно быть строкой.',
            'company_name.max'                  => 'Максимальное количество допустимых символов в имени полльзователя - 255.',
            'company_slug.required'             => 'Необходимо ввести идентификатор компании.',
            'company_slug.string'               => 'Идентификатор компании должен быть строкой.',
            'company_slug.unique'               => 'Такой идентификатор уже используется.',
            'company_slug.regex'                => 'Идентификатор может состоять иж латинских букв, цифр и тирэ.',
        ];
    }
}
