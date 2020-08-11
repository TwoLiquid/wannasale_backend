<?php

namespace App\Http\Requests\Dashboard\Request;

use App\Http\Requests\Dashboard\BaseRequest;
use App\Models\Request;
use Illuminate\Validation\Rule;

class UpdateRequest extends BaseRequest
{
    public function rules() : array
    {
        return [
            'status' => [
                Rule::in(Request::STATUSES)
            ]
        ];
    }

    public function messages() : array
    {
        return [
            'status.in' => 'Несуществующий статус.',
        ];
    }
}
