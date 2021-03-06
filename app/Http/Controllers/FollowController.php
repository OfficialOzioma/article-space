<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function followUserRequest(Request $request)
    {
        $userFollowing = User::find($request->user_id);
        $userFollowed = User::find(auth()->user()->id);
        $response = $userFollowed->toggleFollow($userFollowing);

        // $response = auth()
        //     ->user()
        //     ->toggleFollow($user);

        // if ($response) {
        //     dd($response);
        // } else {
        //     dd('no');
        // }

        dd($response);

        return redirect()->back();

        return response()->json(['success' => $response]);
    }
}