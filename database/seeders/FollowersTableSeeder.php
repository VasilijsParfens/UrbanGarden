<?php

namespace Database\Seeders;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Database\Seeder;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Get all users
        $users = User::all();

        // Loop through each user
        foreach ($users as $user) {
            // Determine a random number of followers (between 1 and 5)
            $numberOfFollowers = rand(1, 5);

            // Get a random set of users to follow the current user
            $followers = User::where('id', '!=', $user->id) // Exclude the user themselves
                ->inRandomOrder()
                ->limit($numberOfFollowers)
                ->get();

            // Assign followers to the current user
            foreach ($followers as $follower) {
                // Ensure the follower is not already following the user
                if (!$user->followers()->where('follower_id', $follower->id)->exists()) {
                    Follower::create([
                        'follower_id' => $follower->id,
                        'followed_id' => $user->id,
                    ]);
                }
            }

            // Determine a random number of users to follow (between 1 and 5)
            $numberOfFollowing = rand(1, 5);

            // Get a random set of users for the current user to follow
            $following = User::where('id', '!=', $user->id) // Exclude the user themselves
                ->inRandomOrder()
                ->limit($numberOfFollowing)
                ->get();

            // Assign users for the current user to follow
            foreach ($following as $followedUser) {
                // Ensure the user is not already following the target user
                if (!$user->following()->where('followed_id', $followedUser->id)->exists()) {
                    Follower::create([
                        'follower_id' => $user->id,
                        'followed_id' => $followedUser->id,
                    ]);
                }
            }
        }
    }
}
