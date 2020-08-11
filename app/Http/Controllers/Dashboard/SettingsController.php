<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\Settings\SaveInfoRequest;
use App\Repositories\UserRepository;
use App\Repositories\VendorRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends BaseController
{
    /**
     * @param UserRepository $userRepo
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(
        UserRepository $userRepo
    )
    {
        $vendor = $this->getVendor();
        $user = $this->getUser();

        $users = $userRepo->getWithoutCurrentForVendor(
            $vendor,
            $user
        );

        return view('dashboard.settings.index', [
            'item'  => $vendor,
            'users' => $users
        ]);
    }

    /**
     * @param SaveInfoRequest $request
     * @param VendorRepository $vendorRepo
     * @param UserRepository $userRepo
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function saveInfo(
        SaveInfoRequest $request,
        VendorRepository $vendorRepo,
        UserRepository $userRepo
    )
    {
        $vendor = $this->getVendor();
        $user = $this->getUser();

        if ($userRepo->checkPassword($user, $request->input('old_password')) === false) {
            return $this->error(
                'Неверный старый пароль.',
                route('dashboard.settings')
            );
        }

        $vendorRepo->setName(
            $vendor,
            $request->input('name')
        );

        $userRepo->updatePassword(
            $user,
            $request->input('password')
        );

        return $this->success(
            'Настройки компании успешно обновлены.',
            route('dashboard.settings')
        );
    }
}
