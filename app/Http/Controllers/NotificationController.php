<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        $notification = Notification::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();
        if ($notification) {
            $notification->update(['read_at' => now()]);
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'Notification not found'], 404);
    }

    public function getNotifications(Request $request)
    {
        $userId = auth()->id();
        $notifications = Notification::where('user_id', $userId)
            ->whereRead_at(null)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($notifications);
    }


}
