<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TipsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Get all user IDs from the users table
        $userIds = DB::table('users')->pluck('id');

        $tips = [
            ['title' => 'How to Water Your Succulents Properly', 'content' => 'Ensure your succulents receive water only when the soil is completely dry to prevent root rot.'],
            ['title' => 'The Best Soil Mix for Indoor Plants', 'content' => 'A mix of peat, perlite, and pine bark works well for most indoor plants.'],
            ['title' => 'How to Propagate a Pothos Plant', 'content' => 'Cut a healthy vine with at least 2 nodes and place it in water until roots appear.'],
            ['title' => 'Signs Your Plant Needs More Sunlight', 'content' => 'If your plant has leggy growth and pale leaves, it likely needs more light.'],
            ['title' => 'The Right Way to Repot Your Plant', 'content' => 'Gently remove the plant, shake off old soil, and place it in a slightly larger pot with fresh soil.'],
            ['title' => 'Preventing Overwatering in Houseplants', 'content' => 'Use well-draining soil and pots with drainage holes to prevent overwatering.'],
            ['title' => 'How to Keep Your Ferns Lush and Green', 'content' => 'Mist your ferns regularly and keep the soil consistently moist but not soggy.'],
            ['title' => 'The Benefits of Using Rainwater for Plants', 'content' => 'Rainwater is free of chlorine and has natural nutrients beneficial for plant growth.'],
            ['title' => 'How to Identify and Treat Spider Mites', 'content' => 'Look for tiny webbing and yellow spots on leaves; treat with neem oil or insecticidal soap.'],
            ['title' => 'The Best Indoor Plants for Low Light Conditions', 'content' => 'Snake plants, ZZ plants, and pothos thrive in low light environments.'],
            ['title' => 'Tips for Growing a Healthy Fiddle Leaf Fig', 'content' => 'Keep it in bright, indirect light and water only when the top inch of soil is dry.'],
            ['title' => 'Why Your Peace Lily’s Leaves Are Turning Yellow', 'content' => 'Overwatering or direct sunlight exposure can cause leaf yellowing.'],
            ['title' => 'The Importance of Fertilizing Your Plants', 'content' => 'Plants need essential nutrients that fertilizers provide, especially during growth periods.'],
            ['title' => 'How to Encourage Your Plant to Bloom', 'content' => 'Ensure it gets enough sunlight, proper nutrients, and the right watering schedule.'],
            ['title' => 'Using Coffee Grounds as Plant Fertilizer', 'content' => 'Coffee grounds add nitrogen to the soil but should be used in moderation.'],
            ['title' => 'How to Keep Your Indoor Plants Dust-Free', 'content' => 'Wipe leaves with a damp cloth regularly to improve photosynthesis.'],
            ['title' => 'The Best Humidity Levels for Your Houseplants', 'content' => 'Most tropical plants prefer 50-60% humidity for optimal growth.'],
            ['title' => 'Choosing the Right Pot for Your Plant', 'content' => 'Terracotta pots allow for better airflow, while plastic retains moisture.'],
            ['title' => 'How to Prune Your Plants for Better Growth', 'content' => 'Remove dead or leggy growth to encourage healthier and fuller growth.'],
            ['title' => 'Why You Should Rotate Your Plants', 'content' => 'Rotating your plants ensures even light exposure and balanced growth.'],
        ];

        foreach ($tips as $tip) {
            DB::table('posts')->insert([
                'user_id' => $faker->randomElement($userIds), // Random user ID
                'type' => 'tip', // Type of post
                'title' => $tip['title'], // Tip title
                'content' => $tip['content'], // Tip content
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
