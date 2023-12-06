<?php

namespace App\services;

use App\Events\NotificationEvent;
use App\Models\Notification;

class NotificationService
{

    public function createAndDispatchNotification($userId, $type, $data)
    {
        // Create notification record
        $notification = Notification::create([
            'user_id' => $userId,
            'type' => $type,
            'data' => json_encode($data),
        ]);

        // Dispatch event to Pusher
        event(new NotificationEvent($userId, $notification->toArray()));
    }
}
