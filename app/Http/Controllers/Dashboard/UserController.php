<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\Settings\InviteUserRequest;
use App\Repositories\UserRepository;
use App\Repositories\VendorRepository;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends BaseController
{
    public function create()
    {
        $vendor = $this->getVendor();

        return view('dashboard.settings.users.invite', [
            'item' => $vendor
        ]);
    }

    public function invite(
        InviteUserRequest $request,
        VendorRepository $vendorRepo,
        UserRepository $userRepo,
        UserService $userService
    )
    {
        $vendor = $this->getVendor();

        $user = $userRepo->findByEmail(
            $request->input('email')
        );

        if ($user === null) {

            $user = $userService->createInvitedUser($vendor, $request->input('email'));

            if ($user === null) {
                return $this->error(
                    'Не удалось создать аккаунт для приглашаемого пользователя.',
                    route('dashboard.settings')
                );
            } else {

                $vendorRepo->syncUsers(
                    $vendor,
                    $user
                );

                return $this->success(
                    'Пользователь с таким E-mail успешно привязан к компании. Данные для входа в аккаунт высланы на его почту.',
                    route('dashboard.settings')
                );

            }

        } else {
            $vendorRepo->syncUsers(
                $vendor,
                $user
            );

            return $this->success(
                'Пользователь с таким E-mail успешно привязан к компании.',
                route('dashboard.settings')
            );
        }
    }

    public function delete(
        string $id,
        UserRepository $userRepository
    )
    {
        $user = $userRepository->findById($id);
        if ($user === null) {
            return $this->error(
                'Пользователь не найден.',
                route('dashboard.users')
            );
        }

        $userRepository->delete($user);

        return $this->warning(
            'Пользователь успешно удалён.',
            route('dashboard.settings')
        );
    }
}
