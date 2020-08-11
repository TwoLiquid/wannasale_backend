<?php

namespace App\Http\Requests\Dashboard\Widget;

use App\Http\Requests\Dashboard\BaseRequest;

class CreateFieldRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'name'          => 'required|string|regex:/^[a-zA-Z]*$/',
            'title'         => 'required|string',
            'type'          => 'required|string',
            'placeholder'   => 'nullable|string',
            'options'       => 'nullable|array',
        ];
    }

    public function messages() : array
    {
        return [
            'name.required'         => 'Необходимо ввести ID поля.',
            'name.string'           => 'ID поля должен быть строкой.',
            'name.regex'            => 'ID поля должно состоять только из латинский символов',
            'type.required'         => 'Необходимо выбрать тип поля.',
            'type.string'           => 'Тип поля должен быть строкой.',
            'placeholder.string'    => 'Подсказка поля ввода должна быть строкой.',
            'options.array'         => 'Список элементов должен быть массивом.'
        ];
    }
}