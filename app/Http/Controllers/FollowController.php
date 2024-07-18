<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Events\FollowUnfollowEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function follow($id)
    {
        try {
            $user = User::find($id);

            if ($user) {
                Auth::user()->following()->attach($user->id);
                // logika follow
                event(new FollowUnfollowEvent(auth()->user(), $user, 'follow'));
                return response()->json(['success' => true, 'message' => 'You are now following ' . $user->name]);
            } else {
                return response()->json(['success' => false, 'message' => 'User not found']);
            }
        } catch (\Exception $e) {
            Log::error('Error in follow method: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred']);
        }
    }

    public function unfollow($id)
    {
        try {
            $user = User::find($id);

            if ($user) {
                Auth::user()->following()->detach($user->id);
                // logika unfollow
                event(new FollowUnfollowEvent(auth()->user(), $user, 'unfollow'));
                return response()->json(['success' => true, 'message' => 'You have unfollowed ' . $user->name]);
            } else {
                return response()->json(['success' => false, 'message' => 'User not found']);
            }
        } catch (\Exception $e) {
            Log::error('Error in unfollow method: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred']);
        }
    }
}