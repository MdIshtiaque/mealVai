<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $requestedId;
    public $data;

    /**
     * Create a new event instance.
     */
    public function __construct($requestedId, $data)
    {
        $this->requestedId = $requestedId;
        $this->data = $data;
    }


    public function broadcastOn()
    {
        return ['user.' . $this->requestedId];
    }

    public function broadcastWith()
    {
        return [
            'data' => $this->data,
            // Add other notification data as needed
        ];
    }

    public function broadcastAs()
    {
        return 'friend_request';
    }
}
