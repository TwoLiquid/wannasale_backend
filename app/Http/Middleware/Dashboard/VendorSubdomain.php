<?php

namespace App\Http\Middleware\Dashboard;

use App\Repositories\VendorRepository;
use Closure;

class VendorSubdomain
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $vendorSlug = app('request')->route('vendorSlug');
        if ($vendorSlug === null) {
            return redirect()->route('home');
        }
        /** @var VendorRepository $vendorRepo */
        $vendorRepo = app(VendorRepository::class);
        $vendor = $vendorRepo->findActiveBySlug($vendorSlug);
        if ($vendor === null) {
            return redirect()->route('home');
        }

        app('url')->defaults([
            'vendorSlug' => $vendorSlug
        ]);
        $request->route()->forgetParameter('vendorSlug');

        return $next($request);
    }
}
