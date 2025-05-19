<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Plant;
use App\Models\User;

class PlantCommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array of possible comments
        $comments = [
            "This plant is thriving in my garden!",
            "I love how easy it is to care for this plant.",
            "The flowers are absolutely beautiful.",
            "This plant is perfect for beginners.",
            "It adds a nice touch of green to my indoor space.",
            "I've had this plant for years and it's still going strong.",
            "The leaves are so vibrant and healthy.",
            "This plant is a great addition to my collection.",
            "It's amazing how fast this plant grows.",
            "I would recommend this plant to anyone.",
            "The fragrance of the flowers is delightful.",
            "This plant is very low maintenance.",
            "It's a great plant for improving indoor air quality.",
            "The colors of the leaves are stunning.",
            "This plant is very resilient and hardy.",
            "I've never had any issues with pests on this plant.",
            "It's a joy to watch this plant grow.",
            "This plant is perfect for small spaces.",
            "The texture of the leaves is unique and interesting.",
            "This plant is a real showstopper in my garden.",
            "I love how it brightens up my room.",
            "The plant's growth has exceeded my expectations.",
            "It's a great conversation starter.",
            "I'm impressed with how well it adapts to different conditions.",
            "The plant's beauty is unmatched.",
            "It's a must-have for any plant lover.",
            "I can't believe how little care it needs.",
            "The plant's resilience is inspiring.",
            "It's a perfect gift for plant enthusiasts.",
            "I'm always amazed by its vibrant colors.",
            'It’s a bit finicky but very rewarding.',
            'This plant is perfect for adding some freshness to my garden.',
            'I love how it adds a natural element to my home.',
            'It’s a bit slow to grow but very beautiful.',
            'This plant is perfect for adding some elegance to my garden.',
            'I love how it adds a touch of greenery to my home.',
            'It’s a bit sensitive to overwatering, so be careful.',
            'This plant is perfect for adding some life to my indoor space.',
            'I love how it adds a natural touch to my decor.',
            'It’s a bit high maintenance but very beautiful.',
            'This plant is perfect for adding some serenity to my home.',
            'I love how it adds a calming presence to my space.',
            'It’s a bit temperamental but worth the effort.',
            'This plant is perfect for adding some tranquility to my garden.',
            'I love how it adds a peaceful vibe to my home.',
            'It’s a bit sensitive to temperature changes, so be mindful.',
            'This plant is perfect for adding some beauty to my home.',
            'I love how it adds a touch of nature to my indoor space.',
            'It’s a bit finicky but very rewarding.',
            'This plant is perfect for adding some freshness to my garden.',
            'I love how it adds a natural element to my home.',
            'It’s a bit slow to grow but very beautiful.',
            'This plant is perfect for adding some elegance to my garden.',
            'I love how it adds a touch of greenery to my home.',
            'It’s a bit sensitive to overwatering, so be careful.',
            'This plant is perfect for adding some life to my indoor space.',
            'I love how it adds a natural touch to my decor.',
            'It’s a bit high maintenance but very beautiful.',
            'This plant is perfect for adding some serenity to my home.',
            'I love how it adds a calming presence to my space.',
            'It’s a bit temperamental but worth the effort.',
            'This plant is perfect for adding some tranquility to my garden.',
            'I love how it adds a peaceful vibe to my home.',
            'It’s a bit sensitive to temperature changes, so be mindful.',
        ];

        // Get all plants and users
        $plants = Plant::all();
        $users = User::all();

        // Total number of comments to generate
        $totalComments = 1000;
        $commentsGenerated = 0;

        while ($commentsGenerated < $totalComments) {
            foreach ($plants as $plant) {
                if ($commentsGenerated >= $totalComments) {
                    break;
                }

                // Random number of comments between 1 and 3 for each plant
                $numberOfComments = rand(1, 3);

                for ($i = 0; $i < $numberOfComments; $i++) {
                    if ($commentsGenerated >= $totalComments) {
                        break;
                    }

                    DB::table('plant_comments')->insert([
                        'plant_id' => $plant->id,
                        'user_id' => $users->random()->id,
                        'content' => $comments[array_rand($comments)],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $commentsGenerated++;
                }
            }
        }
    }
}
