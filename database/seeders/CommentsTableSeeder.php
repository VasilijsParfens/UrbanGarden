<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $numberOfComments = 1000; // Number of comments to generate

        $comments = [];

        for ($i = 0; $i < $numberOfComments; $i++) {
            $comments[] = [
                'user_id' => $faker->numberBetween(1, 1000), // Assuming user IDs range from 1 to 100
                'post_id' => $faker->numberBetween(1, 80),  // Assuming post IDs range from 1 to 50
                'content' => $faker->paragraph,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert the data into the comments table
        DB::table('comments')->insert($comments);
    }
}
