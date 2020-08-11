<?php

namespace App\Http\Middleware\Dashboard;

use App\Models\User;
use App\Repositories\VendorRepository;
use App\Support\Response\GeneralResponseTrait;
use Closure;

class CheckVendorAccess
{
    use GeneralResponseTrait;

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $vendorSlug = get_url_default('vendorSlug');
        if ($vendorSlug !== null) {
            /** @var User|null $user */
            $user = auth(GUARD_DASHBOARD)->user();
            if ($user !== null) {
                /** @var VendorRepository $vendorRepo */
                $vendorRepo = app(VendorRepository::class);
                $vendor = $vendorRepo->findActiveBySlug($vendorSlug);
                if ($vendor === null || $vendorRepo->canBeAccessedByUser($vendor, $user) === false) {
                    $allowedVendor = $vendorRepo->findFirstActiveForUser($user);

                    return $this->warning(
                        'Вы не имеете доступа к панели этой компании.',
                        $allowedVendor !== null
                            ? route('dashboard.home', [], $allowedVendor->slug)
                            : route('home')
                    );
                }
            }
        }

        return $next($request);
    }
}
