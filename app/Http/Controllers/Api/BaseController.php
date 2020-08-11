<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Widget;
use App\Support\Transformers\TransformTrait;
use App\Support\Response\ApiResponseTrait;

/**
 * Class BaseController.
 *
 * @package App\Http\Controllers\Api
 */
abstract class BaseController extends Controller
{
    use ApiResponseTrait;
    use TransformTrait;

    /**
     * @return Widget
     */
    public function getWidget() : Widget
    {
        return auth(GUARD_API)->user();
    }
}
