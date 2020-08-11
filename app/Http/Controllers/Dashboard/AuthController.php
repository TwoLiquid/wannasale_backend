<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Dashboard\Settings\InviteUserRequest;
use App\Notifications\SendUserEmailConfirmMessage;
use App\Repositories\UserRepository;
use App\Repositories\VendorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class AuthController extends BaseController
{
    public function login()
    {
        return view('dashboard.auth.login');
    }

    public function authenticate(
        Request $request,
        VendorRepository $vendorRepo,
        UserRepository $userRepo
    )
    {
        if (
            auth(GUARD_DASHBOARD)->once(
                $request->only('email', 'password')
            ) === false
        ) {
            return $this->error('Неверный логин или пароль.');
        }

        if ($vendorRepo->canBeAccessedByUser($this->getVendor(), $this->getUser()) === false) {
            return $this->error('Вы не имеете доступа к управлению этой компанией.');
        }

        if ($this->getUser()->approved === false) {
            $this->getUser()->notify(new SendUserEmailConfirmMessage($this->getVendor()));

            return $this->error('Необходимо подтвердить E-mail. Письмо с подтверждением повторно отправлено Вам на почту.');
        }

        auth(GUARD_DASHBOARD)
            ->login($this->getUser(), $request->has('remember'));

        return redirect()->intended(route('dashboard.home'));
    }

    public function logout()
    {
        auth(GUARD_DASHBOARD)->logout();

        return redirect(route('home'));
    }

    public function confirmEmail(
        Request $request,
        UserRepository $userRepo
    )
    {
        if ($request->input('email') === null ||
            $request->input('code') === null) {

            return $this->error('В запросе для подтверждения e-mail недостаточно данных.', route('dashboard.login'));
        }

        $user = $userRepo->findByEmail($request->input('email'));

        if ($user === null) {
            return $this->error('Пользователь с таким e-mail не найден.', route('dashboard.login'));
        }

        $userRepo->makeApprove($user);

        return redirect()->intended(route('dashboard.login', ['vendorSlug' => $request->input('vendorSlug')]));
    }
}
