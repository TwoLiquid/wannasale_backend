<?php

namespace App\Http\Middleware\Api;

use App\Repositories\WidgetRepository;
use App\Services\WidgetService;
use App\Support\Response\ApiResponseTrait;
use App\Support\Transformers\TransformTrait;
use Closure;

class Authorize
{
    use ApiResponseTrait;
    use TransformTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $widgetKey = $request->header('authorization');

        if ($widgetKey === null) {
            return $this->respondWithAuthorizationError('В запросе нет заголовка.');
        }

        $widgetRepo = app(WidgetRepository::class);
        $widget = $widgetRepo->findByKey($widgetKey);

        if ($widget === null) {
            return $this->respondWithAuthorizationError('Виджет с таким ключом не найден.');
        }

        $widgetService = app(WidgetService::class);

        if ($widgetService->checkDomainOrigin($widget, request()->header('Origin')) === false) {
            return $this->respondWithAuthorizationError('В настройках сайта нет домена, с которого пришел запрос.');
        }

        if (auth(GUARD_API)->onceUsingId($widget->id) === false) {
            return $this->respondWithAuthorizationError('Не удалось авторизовать виджет.');
        }

        return $next($request);
    }
}
