<?php

namespace App\Events;

use App\Models\FriendRequest;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FriendRequestSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $requestedId;
    public $message;
    /**
     * Create a new event instance.
     */
    public function __construct($requestedId, $message)
    {
        $this->requestedId = $requestedId;
        $this->message = $message;
    }


    public function broadcastOn()
    {
        return ['user.'.$this->requestedId];
    }

    public function broadcastAs(): string
    {
        return 'friend_request_sent';
    }

}
