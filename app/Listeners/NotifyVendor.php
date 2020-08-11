<?php

namespace App\Listeners;

use App\Events\RequestCreated;
use App\Notifications\NotifyUserOfNewRequest;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class NotifyVendor implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  RequestCreated  $event
     * @return void
     */
    public function handle($event)
    {
        if ($event instanceof RequestCreated) {
            $userRepo = app(UserRepository::class);
            $request = $event->getRequest();
            $users = $userRepo->getNotifiableForVendor($request->vendor);

            // TODO:think about catching mail notifications
            try {
                Notification::send($users, new NotifyUserOfNewRequest($request));
            } catch (\Exception $exception) {

            }
        }
    }
}
