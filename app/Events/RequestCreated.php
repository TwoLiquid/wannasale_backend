<?php

namespace App\Events;

use App\Models\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class RequestCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var \App\Models\Request */
    private $request;

    /**
     *
     * Create a new event instance.
     *
     * RequestCreated constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return \App\Models\Request
     */
    public function getRequest() : Request
    {
        return $this->request;
    }
}
