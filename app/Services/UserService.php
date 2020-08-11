<?php

namespace App\Services;

use App\Models\User;
use App\Models\Vendor;
use App\Notifications\SendUserEmailConfirmMessage;
use App\Notifications\UserEmailConfirmWithCredentials;
use App\Repositories\UserRepository;

class UserService
{
    /**
     * @param Vendor $vendor
     * @param string $email
     * @return User|null
     */
    public function createInvitedUser(
        Vendor $vendor,
        string $email
    ) : ?User
    {
        $userRepo = app(UserRepository::class);

        $generatedPassword = str_random(8);

        $user = $userRepo->create(
            get_name_from_email($email),
            $email,
            $generatedPassword,
            false
        );

        if ($user === null) {
            return null;
        }

        $user->notify(new UserEmailConfirmWithCredentials($vendor, $generatedPassword));

        return $user;
    }
}