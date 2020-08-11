<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\RequestCreated;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Request\CreateRequest;
use App\Http\Requests\Api\Widget\CookiesInsertRequest;
use App\Http\Requests\Api\Widget\OpenRequest;
use App\Models\Client;
use App\Models\Item;
use App\Repositories\ClientRepository;
use App\Repositories\ItemRepository;
use App\Repositories\RequestRepository;
use App\Repositories\WidgetEventRepository;
use App\Repositories\WidgetRepository;
use App\Services\WidgetService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MainController extends BaseController
{
    /**
     * @param Request $request
     * @param WidgetService $widgetService
     * @param WidgetEventRepository $widgetEventRepo
     * @return JsonResponse
     * @throws \Throwable
     */
    public function displayWidget(
        Request $request,
        WidgetService $widgetService,
        WidgetEventRepository $widgetEventRepo
    ) : JsonResponse
    {
        if ($request->headers->has('Url') === false) {
            return $this->respondWithSuccess([
                'load' => false,
                'content' => null
            ]);
        }

        $widget = $this->getWidget();

        if ($widgetService->displayedOnPage($widget, $request->header('Url')) === false) {
            return $this->respondWithSuccess([
                'load' => false,
                'content' => null
            ]);
        }

        $items = $widgetService->getItemsForWidget($widget, $request->header('Url'));

        $sessionKey = $widgetService->makeWidgetSessionKey();

        $widgetEvent = $widgetEventRepo->create(
            $widget,
            $sessionKey
        );

        return $this->respondWithSuccess([
            'load' => true,
            'session_key' => $sessionKey,
            'display_settings' => $widget->display_settings->toArray(),
            'content' => view('widget.form', [
                'items' => $items,
                'display_settings'  => $widget->display_settings,
                'custom_fields'     => $widget->custom_fields
            ])->render()
        ]);
    }

    /**
     * @param CreateRequest $request
     * @param RequestRepository $requestRepo
     * @param ItemRepository $itemRepo
     * @param ClientRepository $clientRepo
     * @param WidgetEventRepository $widgetEventRepo
     * @return JsonResponse
     */
    public function setWidgetRequest(
        CreateRequest $request,
        RequestRepository $requestRepo,
        ItemRepository $itemRepo,
        ClientRepository $clientRepo,
        WidgetEventRepository $widgetEventRepo
    ) : JsonResponse
    {
        $widget = $this->getWidget();

        $item = null;
        if ($request->has('item_id')) {
            $item = $itemRepo->findById($request->input('item_id'));
        }

        $customFields = [];
        foreach ($request->input('custom_fields') as $field) {
            $customFields[] = [
                'name'  => $field['name'],
                'title' => $field['title'],
                'value' => $field['value']
            ];
        }

        $createdRequest = $requestRepo->createForWidget(
            $widget,
            $item,
            null,
            $request->input('name'),
            $request->input('item_name'),
            $request->input('email'),
            $request->input('phone'),
            $request->headers->has('Url') ? $request->header('Url') : null,
            $request->headers->has('IP') ? $request->header('IP') : null,
            null,
            $request->headers->has('User-Agent') ? $request->header('User-Agent') : null,
            $request->input('offered_price'),
            $request->input('currency'),
            $request->input('ip_country'),
            $request->input('ip_city'),
            $customFields
        );

        if ($createdRequest === null) {
            return $this->respondWithError('Не удалось добавить запрос.');
        }

        $client = $clientRepo->getByInfo(
            $createdRequest->vendor,
            $createdRequest->name,
            $createdRequest->email,
            $createdRequest->phone
        );

        if ($client === null) {
            $client = $clientRepo->create(
                $createdRequest->vendor,
                $createdRequest->name,
                $createdRequest->email,
                $createdRequest->phone
            );
        }

        $requestRepo->setClient($createdRequest, $client);

        $widgetEvent = $widgetEventRepo->findBySessionKey($request->input('session_key'));

        if ($widgetEvent !== null) {
            $widgetEventRepo->update(
                $widgetEvent,
                $createdRequest,
                true
            );
        }

        event(new RequestCreated($createdRequest));

        return $this->respondWithSuccess(null, 'Вы успешно отправили запрос на предложение цены.')
            ->cookie(cookie('wannasale_name', $request->input('name')))
            ->cookie(cookie('wannasale_email', $request->input('email')))
            ->cookie(cookie('wannasale_phone', $request->input('phone')))
            ->cookie(cookie('wannasale_country', $request->input('country')));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function initCookies()
    {
        return view('api.widget.cookies');
    }

    /**
     * @param OpenRequest $request
     * @param WidgetEventRepository $widgetEventRepo
     * @return JsonResponse
     */
    public function setWidgetOpen(
        OpenRequest $request,
        WidgetEventRepository $widgetEventRepo
    ) : JsonResponse
    {
        $widgetEvent = $widgetEventRepo->findBySessionKey(
            $request->input('session_key')
        );

        if ($widgetEvent === null) {
            return $this->respondWithSuccess(null, 'Не удалось добавить действие с виджетом.');
        }

        $widgetEventRepo->update(
            $widgetEvent,
            null,
            true
        );

        return $this->respondWithSuccess(null, 'Клиент открыл виджет.');
    }
}
