<?php

namespace App\Http\Requests\Dashboard\Subscription;

use App\Http\Requests\Dashboard\BaseRequest;

class SubscriptionCreateRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'rate'      => 'required|string|exists:rates,id'
        ];
    }

    public function messages() : array
    {
        return [
            'rate.required'         => 'Необходим ID тарифа.',
            'rate.string'           => 'ID тарифа должен быть строкой.',
            'rate.exists'           => 'Тариф с таким ID не найден.'
        ];
    }
}