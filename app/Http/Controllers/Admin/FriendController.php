<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FriendRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function addFriend(): View|Application|Factory
    {
        return view('admin.pages.friend.add', ['title' => 'Add Friend']);
    }

    public function sendRequest(Request $request): JsonResponse
    {
        $userId = $request->input('user_id');

        FriendRequest::create([
            'requester_id' => auth()->user()->id,
            'requested_id' => $userId,
            'status' => FriendRequest::STATUS_PENDING
        ]);

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
