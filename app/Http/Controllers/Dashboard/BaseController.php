<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use App\Repositories\SiteRepository;
use App\Repositories\VendorRepository;
use App\Support\Response\ApiResponseTrait;
use App\Support\Response\GeneralResponseTrait;

abstract class BaseController extends Controller
{
    use ApiResponseTrait;
    use GeneralResponseTrait;

    /** @var Vendor|null */
    private $vendor = null;

    /**
     * @return User|null
     */
    public function getUser() : ?User
    {
        return auth(GUARD_DASHBOARD)->user();
    }

    /**
     * @return User|null
     */
    public function getVendor() : ?Vendor
    {
        if ($this->vendor === null) {
            /** @var VendorRepository $vendorRepo */
            $vendorRepo = app(VendorRepository::class);
            $this->vendor = $vendorRepo->findActiveBySlug(
                get_url_default('vendorSlug')
            );
        }

        return $this->vendor;
    }

    /**
     * @return null|string
     */
    public function getActiveSiteId() : ?string
    {
        if (session()->exists('activeSiteId') === false) {
            return $this->refreshActiveSiteId();
        } else {
            $activeSiteId = session()->get('activeSiteId');
            if ($activeSiteId !== null) {
                /** @var SiteRepository $siteRepo */
                $siteRepo = app(SiteRepository::class);
                if ($siteRepo->existsByIdForVendor($activeSiteId, $this->getVendor()) === false) {
                    return $this->refreshActiveSiteId();
                }
            }
        }

        return $activeSiteId;
    }

    /**
     * @return null|string
     */
    private function refreshActiveSiteId() : ?string
    {
        /** @var SiteRepository $siteRepo */
        $siteRepo = app(SiteRepository::class);
        $site = $siteRepo->findLatestForVendor($this->getVendor());
        $activeSiteId = $site !== null
            ? $site->id
            : null;
        $this->setActiveSiteId($activeSiteId);

        return $activeSiteId;
    }

    /**
     * @param null|string $siteId
     */
    public function setActiveSiteId(?string $siteId) : void
    {
        session()->put('activeSiteId', $siteId);
    }
}
