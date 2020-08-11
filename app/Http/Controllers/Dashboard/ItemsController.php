<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\Item\CreateRequest;
use App\Repositories\ItemRepository;
use App\Repositories\RequestMessageRepository;
use App\Repositories\RequestRepository;
use App\Repositories\SiteRepository;
use App\Services\AnalyticsService;

class ItemsController extends BaseController
{
    /**
     * @param string $id
     * @param SiteRepository $siteRepo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function create(string $id, SiteRepository $siteRepo)
    {
        $site = $siteRepo->findByIdForVendor($id, $this->getVendor());
        if ($site === null) {
            return $this->error(
                'Сайт не найден.',
                route('dashboard.sites')
            );
        }

        return view('dashboard.items.create', [
            'site' => $site
        ]);
    }

    /**
     * @param string $id
     * @param SiteRepository $siteRepo
     * @param CreateRequest $request
     * @param ItemRepository $itemRepo
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function store(string $id, CreateRequest $request, SiteRepository $siteRepo, ItemRepository $itemRepo)
    {
        $site = $siteRepo->findByIdForVendor($id, $this->getVendor());
        if ($site === null) {
            return $this->error(
                'Сайт не найден.',
                route('dashboard.sites')
            );
        }

        $item = $itemRepo->createForSite(
            $site,
            $request->input('name'),
            $request->input('code'),
            $request->input('initial_price'),
            $request->input('min_acceptable_price'),
            $request->input('min_unacceptable_price'),
            $request->input('urls', [])
        );

        return $this->success(
            'Товар добавлен.',
            route('dashboard.items.edit', $item->id)
        );
    }

    /**
     * @param string $id
     * @param ItemRepository $itemRepo
     * @param AnalyticsService $analyticsService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(
        string $id,
        ItemRepository $itemRepo,
        AnalyticsService $analyticsService
    )
    {
        $item = $itemRepo->findById($id);
        if ($item === null) {
            return $this->error(
                'Товар не найден.',
                route('dashboard.sites')
            );
        }

        $itemGraph = $analyticsService->getItemGraphInfo($item);

        return view('dashboard.items.edit', [
            'item'          => $item,
            'itemGraph'     => $itemGraph
        ]);
    }

    /**
     * @param string $id
     * @param CreateRequest $request
     * @param ItemRepository $itemRepo
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function update(string $id, CreateRequest $request, ItemRepository $itemRepo)
    {
        $item = $itemRepo->findById($id);
        if ($item === null) {
            return $this->error(
                'Товар не найден.',
                route('dashboard.sites')
            );
        }
        $itemRepo->update(
            $item,
            $request->input('name'),
            $request->input('code'),
            $request->input('initial_price'),
            $request->input('min_acceptable_price'),
            $request->input('min_unacceptable_price'),
            $request->input('urls', [])
        );

        return $this->success(
            'Товар изменён.',
            route('dashboard.items.edit', $item->id)
        );
    }

    /**
     * @param string $id
     * @param ItemRepository $itemRepo
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function delete(string $id, ItemRepository $itemRepo)
    {
        $item = $itemRepo->findById($id);
        if ($item === null) {
            return $this->error('Товар не найден.');
        }
        $siteId = $item->site_id;
        $itemRepo->delete($item);

        return $this->warning(
            'Товар удалён.',
            route('dashboard.sites.view', $siteId)
        );
    }
}
