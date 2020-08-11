<?php

namespace App\Providers;

use App\Models\User;
use App\Repositories\SiteRepository;
use App\Repositories\VendorRepository;
use App\Services\VendorPermissionService;
use View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('dashboard.layouts.vendor-select', function ($view) {
            /** @var \Illuminate\View\View $view */

            /** @var VendorRepository $vendorRepo */
            $vendorRepo = app(VendorRepository::class);
            /** @var User $user */
            $user = auth(GUARD_DASHBOARD)->user();
            $vendors = $vendorRepo->getActiveForUser($user);
            $view->with('vendors', $vendors);
        });

        View::composer('dashboard.layouts.sidebar', function ($view) {
            /** @var \Illuminate\View\View $view */

            /** @var VendorRepository $vendorRepo */
            $vendorRepo = app(VendorRepository::class);

            $vendor = $vendorRepo->findActiveBySlug(
                get_url_default('vendorSlug')
            );

            if ($vendor !== null) {
                /** @var SiteRepository $siteRepo */
                $siteRepo = app(SiteRepository::class);
                /** @var VendorPermissionService $vendorPermissionService */
                $vendorPermissionService = app(VendorPermissionService::class);

                $sites = $siteRepo->getForVendor($vendor);
                $canAddSite = $vendorPermissionService->canAddSite($vendor);

                $view->with('sites', $sites)
                    ->with('canAddSite', $canAddSite);
            }
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
