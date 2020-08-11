<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\Request\Message\CreateRequest;
use App\Http\Requests\Dashboard\Request\Message\SetPriceRequest;
use App\Http\Requests\Dashboard\Request\UpdateRequest;
use App\Models\Request;
use App\Notifications\SendMessageToClient;
use App\Repositories\ClientRepository;
use App\Repositories\ItemRepository;
use App\Repositories\RequestMessageRepository;
use App\Repositories\RequestRepository;
use App\Repositories\SiteRepository;
use App\Repositories\WidgetRepository;
use App\Services\AnalyticsService;
use App\Services\MailService;
use Illuminate\Http\Request as HttpRequest;
use App\Http\Requests\Dashboard\Request\CreateRequest as NewRequestCreate;

class RequestsController extends BaseController
{
    /**
     * @param RequestRepository $requestRepo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(RequestRepository $requestRepo)
    {
        $requests = $requestRepo->getByVendorPaginated($this->getVendor());

        return view('dashboard.requests.index', [
            'requests' => $requests
        ]);
    }

    public function create()
    {
        $vendor = $this->getVendor();

        return view('dashboard.requests.create', [
            'sites'     => $vendor->sites
        ]);
    }

    public function store(
        NewRequestCreate $request,
        WidgetRepository $widgetRepo,
        ItemRepository $itemRepo,
        ClientRepository $clientRepo,
        RequestRepository $requestRepo)
    {
        $widget = $widgetRepo->findById($request->input('widget_id'));
        if ($widget === null) {
            return $this->error(
                'Виджет не найден.',
                route('dashboard.requests.create')
            );
        }

        $item = $itemRepo->findById($request->input('item_id'));
        if ($item === null) {
            return $this->error(
                'Товар не найден.',
                route('dashboard.requests.create')
            );
        }

        $client = $clientRepo->findById($request->input('client_id'));
        if ($client === null) {
            return $this->error(
                'Клиент не найден.',
                route('dashboard.requests.create')
            );
        }

        $request = $requestRepo->createForWidget(
            $widget,
            $item,
            $client,
            $request->input('name'),
            $request->input('item_name') == '' ? null : $request->input('item_name'),
            $request->input('email'),
            $request->input('phone'),
            null,
            null,
            null,
            null,
            $request->input('offered_price'),
            config('currency.default.code'),
            $request->input('country') == '' ? null : $request->input('country'),
            $request->input('city') == '' ? null : $request->input('city')
        );

        if ($request === null) {
            return $this->error(
                'Не удалось добавить новый запрос.',
                route('dashboard.requests.create')
            );
        }

        return redirect()->route('dashboard.requests');
    }

    /**
     * @param HttpRequest $request
     * @param SiteRepository $siteRepo
     * @param WidgetRepository $widgetRepo
     * @param ClientRepository $clientRepo
     * @param ItemRepository $itemRepo
     * @return array
     */
    public function getSiteRelatedData(
        HttpRequest $request,
        SiteRepository $siteRepo,
        WidgetRepository $widgetRepo,
        ClientRepository $clientRepo,
        ItemRepository $itemRepo
    )
    {
        $siteId = $request->input('site_id');
        $site = $siteRepo->findByIdForVendor($siteId, $this->getVendor());
        $widget = $widgetRepo->getBySite($site);
        $clients = $clientRepo->getByVendor($this->getVendor());
        $items = $itemRepo->getForSite($site);

        return [
            'widget'    => $widget->id,
            'clients'   => $clients->pluck('name', 'id')->toArray(),
            'items'     => $items->pluck('name', 'id')->toArray()
        ];
    }

    /**
     * @param string $id
     * @param RequestRepository $requestRepo
     * @param RequestMessageRepository $requestMessageRepo
     * @param AnalyticsService $analyticsService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function view(
        string $id,
        RequestRepository $requestRepo,
        RequestMessageRepository $requestMessageRepo,
        AnalyticsService $analyticsService
    )
    {
        $request = $requestRepo->findByIdForVendor($id, $this->getVendor());
        if ($request === null) {
            return $this->error(
                'Запрос не найден.',
                route('dashboard.requests')
            );
        }



        $requestMessages = $requestMessageRepo->getForRequest($request);
        $messageTemplates = config('mail.templates');

        return view('dashboard.requests.view', [
            'request' => $request,
            'messages' => $requestMessages,
            'messageTemplates' => $messageTemplates
        ]);
    }

    /**
     * @param string $id
     * @param CreateRequest $httpRequest
     * @param RequestRepository $requestRepo
     * @param RequestMessageRepository $requestMessageRepo
     * @param MailService $mailService
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Webklex\IMAP\Exceptions\ConnectionFailedException
     */
    public function sendMessage(
        string $id,
        CreateRequest $httpRequest,
        RequestRepository $requestRepo,
        RequestMessageRepository $requestMessageRepo,
        MailService $mailService
    )
    {
        $request = $requestRepo->findByIdForVendor($id, $this->getVendor());
        if ($request === null) {
            return $this->error(
                'Запрос не найден.',
                route('dashboard.requests')
            );
        }

        $mailService->sendMailToClient(
            $request->site,
            $request->client,
            $httpRequest->input('title'),
            $httpRequest->input('text')
        );

        $requestMessage = $requestMessageRepo->createForRequest(
            $request,
            false,
            $httpRequest->input('title'),
            $httpRequest->input('text'),
            $httpRequest->input('offered_price')
        );

        $requestRepo->improveStatus(
            $request,
            Request::STATUS_WAITING_FOR_CLIENT);

        return redirect()->route('dashboard.requests.view', ['id' => $request->id]);
    }

    /**
     * @param string $id
     * @param UpdateRequest $httpRequest
     * @param RequestRepository $requestRepo
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(string $id, UpdateRequest $httpRequest, RequestRepository $requestRepo)
    {
        $request = $requestRepo->findByIdForVendor($id, $this->getVendor());
        if ($request === null) {
            return $this->error(
                'Запрос не найден.',
                route('dashboard.requests')
            );
        }

        $requestRepo->setStatus(
            $request,
            $httpRequest->input('status')
        );

        if ($httpRequest->has('total_price')) {

            $requestRepo->setProposalsHistory($request);

            $requestRepo->setTotalPrice(
                $request,
                $httpRequest->input('total_price')
            );
        }

        return $this->success('Изменения успешно применены.');
    }

    /**
     * @param string $id
     * @param RequestRepository $requestRepo
     * @param MailService $mailService
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateClientMessages(string  $id, RequestRepository $requestRepo, MailService $mailService)
    {
        $request = $requestRepo->findByIdForVendor($id, $this->getVendor());
        if ($request === null) {
            return $this->error(
                'Запрос не найден.',
                route('dashboard.requests')
            );
        }

        $mailService->updateRequestsMessages();

        return redirect()->route('dashboard.requests.view', ['id' => $request->id]);
    }

    /**
     * @param string $id
     * @param SetPriceRequest $httpRequest
     * @param RequestRepository $requestRepo
     * @param RequestMessageRepository $requestMessageRepo
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function setMessagePrice(string $id, SetPriceRequest $httpRequest, RequestRepository $requestRepo, RequestMessageRepository $requestMessageRepo)
    {
        $request = $requestRepo->findByIdForVendor($id, $this->getVendor());
        if ($request === null) {
            return $this->error(
                'Запрос не найден.',
                route('dashboard.requests')
            );
        }

        $requestMessage = $requestMessageRepo->findForRequestById($request, $httpRequest->input('message_id'));

        if ($requestMessage === null) {
            return $this->error(
                'Сообщение не найдено.',
                route('dashboard.requests.view', $request->id)
            );
        }

        $requestMessageRepo->setPrice(
            $requestMessage,
            $httpRequest->input('offered_price')
        );

        return $this->success(
            'Предлагаемая цена успешно указана.',
            route('dashboard.requests.view', $request->id)
        );
    }

    /**
     * @param string $id
     * @param RequestRepository $requestRepo
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function delete(string $id, RequestRepository $requestRepo)
    {
        $request = $requestRepo->findByIdForVendor($id, $this->getVendor());
        if ($request === null) {
            return $this->error('Запрос не найден.');
        }
        $requestRepo->delete($request);

        return $this->warning(
            'Запрос удалён.',
            route('dashboard.requests')
        );
    }
}
