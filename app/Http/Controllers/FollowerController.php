<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    // Follow a user
    public function follow(User $user)
    {
        if (Auth::id() == $user->id) {
            return back()->with('error', 'You cannot follow yourself.');
        }

        $exists = Follower::where('follower_id', Auth::id())
            ->where('followed_id', $user->id)
            ->exists();

        if ($exists) {
            return back()->with('message', 'You are already following this user.');
        }

        Follower::create([
            'follower_id' => Auth::id(),
            'followed_id' => $user->id,
        ]);

        return back()->with('success', 'You are now following ' . $user->name);
    }

    // Unfollow a user
    public function unfollow(User $user)
    {
        Follower::where('follower_id', Auth::id())
            ->where('followed_id', $user->id)
            ->delete();

        return back()->with('success', 'You have unfollowed ' . $user->name);
    }

    // Optional: list of followers
    public function followers(User $user)
    {
        $followers = $user->followers()->with('follower')->get();

        return view('followers.index', compact('user', 'followers'));
    }

    // Optional: list of following
    public function following(User $user)
    {
        $following = $user->following()->with('followed')->get();

        return view('following.index', compact('user', 'following'));
    }
}
