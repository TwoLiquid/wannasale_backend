<?php

namespace App\Events;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class VendorCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var \App\Models\Vendor */
    private $vendor;

    /** @var \App\Models\User */
    private $user;

    /**
     * VendorCreated constructor.
     * @param Vendor $vendor
     * @param User $user
     */
    public function __construct(Vendor $vendor, User $user)
    {
        $this->vendor = $vendor;
        $this->user = $user;
    }

    /**
     * @return Vendor
     */
    public function getVendor() : Vendor
    {
        return $this->vendor;
    }

    /**
     * @return User
     */
    public function getUser() : User
    {
        return $this->user;
    }
}
