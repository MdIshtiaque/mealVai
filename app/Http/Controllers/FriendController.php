<?php

namespace App\Http\Controllers;

use App\Models\FriendRequest;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function addFriend()
    {
        return view('admin.pages.friend.add', ['title' => 'Add Friend']);
    }

    public function sendRequest(Request $request)
    {
        $userId = $request->input('user_id');

        FriendRequest::create([
            'requester_id' => auth()->user()->id,
            'requested_id' => $userId,
            'status' => FriendRequest::STATUS_PENDING
        ]);

        return response()->json(['success' => true]);
    }

    public function cancelRequest(Request $request)
    {
        $userId = $request->input('user_id');
        $cancelRequest = FriendRequest::whereRequester_id(auth()->user()->id)->whereRequested_id($userId)->first();
        $cancelRequest->delete();
        return response()->json(['success' => true]);
    }


}
