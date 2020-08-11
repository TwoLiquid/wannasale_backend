<?php

namespace App\Http\Controllers\Front;

use App\Events\VendorCreated;
use App\Http\Requests\Front\Auth\RegisterRequest;
use App\Repositories\UserRepository;
use App\Repositories\VendorRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function registerView()
    {
        return view('front.auth.register');
    }

    public function registerMake(
        RegisterRequest $request,
        UserRepository $userRepo,
        VendorRepository $vendorRepo
    )
    {
        $user = $userRepo->create(
            $request->input('user_name'),
            $request->input('user_email'),
            $request->input('user_password'),
            false
        );

        $vendor = $vendorRepo->create(
            $request->input('company_name'),
            $request->input('company_slug'),
            true,
            1
        );

        event(new VendorCreated($vendor, $user));

        $vendorRepo->syncUsers(
            $vendor,
            $user
        );

        return redirect()->route('dashboard.home', ['vendorSlug' => $vendor->slug]);
    }
}
