<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class QuestionsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Get all user IDs from the users table
        $userIds = DB::table('users')->pluck('id');

        $questions = [
            ['title' => 'What are the best indoor plants for beginners?', 'content' => 'Can someone recommend easy-to-care-for plants for people new to gardening?'],
            ['title' => 'How can I tell if my plant is getting too much sunlight?', 'content' => 'What are the signs that my plant is getting too much sunlight and how can I fix it?'],
            ['title' => 'Why are my plant leaves turning yellow?', 'content' => 'I’ve noticed that some of my plant’s leaves are turning yellow. What could be the reason?'],
            ['title' => 'How often should I water my cactus?', 'content' => 'What’s the best watering schedule for a cactus, and what are the signs of overwatering?'],
            ['title' => 'What’s the best way to propagate a snake plant?', 'content' => 'I have a snake plant, and I’m curious about the best way to propagate it. Any advice?'],
            ['title' => 'How do I fix a plant that’s been overwatered?', 'content' => 'My plant seems to have been overwatered. What steps can I take to help it recover?'],
            ['title' => 'What are the signs that my plant is root-bound?', 'content' => 'How can I tell if my plant is root-bound and what should I do to resolve it?'],
            ['title' => 'How do I fertilize my houseplants?', 'content' => 'What type of fertilizer should I use for my indoor plants, and how often should I apply it?'],
            ['title' => 'What’s the best way to repot my plant?', 'content' => 'I want to repot my plant, but I’m not sure about the process. What’s the best way to go about it?'],
            ['title' => 'Why does my peace lily keep dropping leaves?', 'content' => 'My peace lily has been dropping leaves consistently. What might be the cause of this?'],
            ['title' => 'How do I prevent my plant from getting pests?', 'content' => 'What steps can I take to prevent pests like aphids or spider mites from attacking my plants?'],
            ['title' => 'What’s the difference between pruning and trimming?', 'content' => 'Is there a difference between pruning and trimming a plant, and when should I do each?'],
            ['title' => 'Can I use tap water for my plants?', 'content' => 'Is it safe to use tap water for my plants, or should I be using distilled or filtered water?'],
            ['title' => 'How do I know if my plant needs more humidity?', 'content' => 'What signs should I look for if my plant is lacking humidity?'],
            ['title' => 'When is the best time to prune a plant?', 'content' => 'Is there a specific season or time of year that is best for pruning my plants?'],
            ['title' => 'Can I grow vegetables indoors?', 'content' => 'I’m interested in growing vegetables indoors. Is this possible, and what are some tips?'],
            ['title' => 'How do I make my plant bloom?', 'content' => 'I have a flowering plant, but it’s not blooming. What can I do to encourage it to bloom?'],
            ['title' => 'What are some low-maintenance plants?', 'content' => 'Can you recommend some plants that are low-maintenance and ideal for busy people?'],
            ['title' => 'How do I keep my plants healthy during the winter?', 'content' => 'What care steps should I take to ensure my plants thrive during the colder months?'],
            ['title' => 'Why is my plant growing so slowly?', 'content' => 'I’ve noticed that my plant is growing very slowly. What could be causing this, and how can I help it grow faster?']
        ];

        foreach ($questions as $question) {
            DB::table('posts')->insert([
                'user_id' => $faker->randomElement($userIds), // Random user ID
                'type' => 'question', // Type of post
                'title' => $question['title'], // Question title
                'content' => $question['content'], // Question content
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
