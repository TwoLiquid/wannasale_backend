<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\SiteCreated;
use App\Http\Requests\Dashboard\Site\CreateRequest;
use App\Imports\ItemsImport;
use App\Models\Site;
use App\Repositories\ItemRepository;
use App\Repositories\SiteRepository;
use App\Services\AnalyticsService;
use App\Services\VendorPermissionService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SitesController extends BaseController
{
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $activeSiteId = $this->getActiveSiteId();

        $site = Site::find(2);
        $site->vendor;

        return $activeSiteId !== null
            ? redirect()->route('dashboard.sites.view', $activeSiteId)
            : redirect()->route('dashboard.sites.create');
    }

    /**
     * @param VendorPermissionService $vendorPermissionService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function create(VendorPermissionService $vendorPermissionService)
    {
        if ($vendorPermissionService->canAddSite($this->getVendor()) === false) {
            return $this->error('Вы уже добавили максимальное количество сайтов.');
        }

        return view('dashboard.sites.create');
    }

    /**
     * @param CreateRequest $request
     * @param SiteRepository $siteRepo
     * @param VendorPermissionService $vendorPermissionService
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function store(
        CreateRequest $request,
        SiteRepository $siteRepo,
        VendorPermissionService $vendorPermissionService
    ) {
        if ($vendorPermissionService->canAddSite($this->getVendor()) === false) {
            return $this->error('Вы уже добавили максимальное количество сайтов.');
        }

        $parsedDomain = parse_domain($request->input('url'));

        if ($parsedDomain === null) {
            return $this->error('Неверный формат домена.');
        }

        $site = $siteRepo->createForVendor(
            $this->getVendor(),
            $request->input('name'),
            $parsedDomain
        );

        if ($site === null) {
            return $this->error('Не удалось добавить сайт.');
        }

        event(new SiteCreated($site));

        return $this->success(
            'Сайт добавлен.',
            route('dashboard.sites.view', $site->id)
        );
    }

    /**
     * @param string $id
     * @param SiteRepository $siteRepo
     * @param ItemRepository $itemRepo
     * @param AnalyticsService $analyticsService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\View\View|\Symfony\Component\HttpFoundation\Response
     */
    public function view(
        string $id,
        SiteRepository $siteRepo,
        ItemRepository $itemRepo,
        AnalyticsService $analyticsService
    )
    {
        $site = $siteRepo->findByIdForVendor($id, $this->getVendor());
        if ($site === null) {
            return $this->error(
                'Сайт не найден.',
                route('dashboard.sites')
            );
        }

        $this->setActiveSiteId($site->id);

        $items = $itemRepo->getForSitePaginated($site);

        $widgetFunnel = $analyticsService->getWidgetFunnelInfo($site->widget);

        return view('dashboard.sites.view', [
            'site'          => $site,
            'items'         => $items,
            'widgetFunnel'  => $widgetFunnel
        ]);
    }

    /**
     * @param string $id
     * @param CreateRequest $request
     * @param SiteRepository $siteRepo
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function update(string $id, CreateRequest $request, SiteRepository $siteRepo)
    {
        $site = $siteRepo->findByIdForVendor($id, $this->getVendor());
        if ($site === null) {
            return $this->error(
                'Сайт не найден.',
                route('dashboard.sites')
            );
        }

        $parsedDomain = parse_domain($request->input('url'));

        if ($parsedDomain === null) {
            return $this->error('Неверный формат домена.');
        }

        $siteRepo->update(
            $site,
            $request->input('name'),
            $parsedDomain
        );

        return $this->success(
            'Сайт изменён.',
            route('dashboard.sites.view', $site->id)
        );
    }

    public function excel(string $id, SiteRepository $siteRepo)
    {
        $site = $siteRepo->findByIdForVendor($id, $this->getVendor());
        if ($site === null) {
            return $this->error(
                'Сайт не найден.',
                route('dashboard.sites')
            );
        }

        return view('dashboard.sites.excel', [
            'site' => $site
        ]);
    }

    public function excelImport(string $id, Request $request, SiteRepository $siteRepo)
    {
        $site = $siteRepo->findByIdForVendor($id, $this->getVendor());
        if ($site === null) {
            return $this->error(
                'Сайт не найден.',
                route('dashboard.sites')
            );
        }

        Excel::import(new ItemsImport($site), $request->file('file'));

        return redirect()->route('dashboard.sites.view', $site->id) ;
    }

    /**
     * @param string $id
     * @param SiteRepository $siteRepo
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function delete(string $id, SiteRepository $siteRepo)
    {
        $site = $siteRepo->findByIdForVendor($id, $this->getVendor());
        if ($site === null) {
            return $this->error(
                'Сайт не найден.',
                route('dashboard.sites')
            );
        }

        $siteRepo->delete($site);

        return $this->warning(
            'Сайт удалён.',
            route('dashboard.sites')
        );
    }
}
