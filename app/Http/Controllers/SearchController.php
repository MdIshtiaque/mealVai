<?php

namespace App\Http\Controllers;

use App\Models\FriendRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function searchUsers(Request $request): string
    {
        $query = $request->input('query');
        $userId = auth()->id();

        $results = User::where('name', 'LIKE', "%$query%")
            ->orWhere('email', 'LIKE', "%$query%")
            ->get()
            ->except(Auth::id());

        $requestedIds = auth()->user()->friendRequests->pluck('requested_id')->toArray();

        $html = '';

        if ($results->count() > 0) {
            foreach ($results as $user) {
                $isRequested = in_array($user->id, $requestedIds);
                $html .= '<tr class="item">';
                $html .= '<td>' . $user->name . '</td>';
                $html .= $isRequested ? '<td><button type="button" class="btn btn-primary btn-rounded btn-bordered cancel-friend-request" data-user-id="' . $user->id . '"><i class="fa fa-arrow-right"></i>Cancel</button></td>' : '<td><button type="button" class="btn btn-primary btn-rounded btn-bordered add-friend" data-user-id="' . $user->id . '"><i class="fa fa-user-plus"></i>Add</button></td>';

                $html .= '</tr>';
            }
        } else {
            $html = '<td>No results found.</td>';
        }

        return $html;
    }

}
