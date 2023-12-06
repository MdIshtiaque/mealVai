<?php

namespace App\Http\Controllers\Admin;


use App\Events\FriendRequestSent;
use App\Http\Controllers\Controller;
use App\Models\FriendRequest;
use App\services\NotificationService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{
    public function addFriend(): View|Application|Factory
    {
        return view('admin.pages.friend.add', ['title' => 'Add Friend']);
    }

    public function sendRequest(Request $request): JsonResponse
    {
        DB::beginTransaction();
        $userId = $request->input('user_id');

        $friendRequest = FriendRequest::create([
            'requester_id' => auth()->user()->id,
            'requested_id' => $userId,
            'status' => FriendRequest::STATUS_PENDING
        ]);

        $requesterName = auth()->user()->name;

//        event(new FriendRequestSent($friendRequest->requested_id, 'Friend Request Sent'));
        $notificationService = new NotificationService();
        $notificationService->createAndDispatchNotification(
            $friendRequest->requested_id,
            'friend_request',
            ['message' => 'A New Friend Request from ' . $friendRequest->sender->name]
        );
        DB::commit();
        return response()->json(['success' => true]);
    }

    public function cancelRequest(Request $request): JsonResponse
    {
        $userId = $request->input('user_id');
        $cancelRequest = FriendRequest::whereRequester_id(auth()->user()->id)->whereRequested_id($userId)->first();
        $cancelRequest->delete();
        return response()->json(['success' => true]);
    }


}
