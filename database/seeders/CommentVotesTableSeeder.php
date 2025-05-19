<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CommentVotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $votesPerComment = 10; // Number of votes per comment

        // Assuming user IDs range from 1 to 1000
        $allUserIds = range(1, 1000);

        // Retrieve all comment IDs
        $commentIds = DB::table('comments')->pluck('id')->toArray();

        foreach ($commentIds as $commentId) {
            $commentVotes = [];

            // Pick N unique user IDs randomly
            $voterIds = collect($allUserIds)->shuffle()->take($votesPerComment);

            foreach ($voterIds as $userId) {
                $commentVotes[] = [
                    'user_id' => $userId,
                    'comment_id' => $commentId,
                    'is_upvote' => $faker->boolean,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Insert all votes for this comment
            DB::table('comment_votes')->insert($commentVotes);
        }
    }
}
