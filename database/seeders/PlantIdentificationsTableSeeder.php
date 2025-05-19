<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PlantIdentificationsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $numberOfPosts = 20;

        $userIds = DB::table('users')->pluck('id');

        $plantDescriptions = [
            "Found this plant in my backyard. It has large, glossy leaves with white flowers. Can anyone help identify it?",
            "Saw this plant on a hike. It has small yellow flowers and spiky leaves. Any ideas?",
            "This plant is growing in my garden, but I didn't plant it. It has purple flowers and thick stems.",
            "Found this plant near a river. It has long, narrow leaves and small white berries.",
            "This plant has red flowers and grows in clusters. Can someone tell me what it is?",
            "I found this plant in a forest. It has heart-shaped leaves and tiny blue flowers.",
            "This plant is growing in a shady area. It has large, green leaves and no flowers.",
            "Found this plant in a park. It has small pink flowers and serrated leaves.",
            "This plant has thick, waxy leaves and orange flowers. Can anyone identify it?",
            "Found this plant in a desert area. It has small, spiky leaves and yellow flowers.",
            "This plant has long, trailing vines and small white flowers. What is it?",
            "Found this plant near a lake. It has large, round leaves and purple flowers.",
            "This plant has small, star-shaped flowers and grows in sandy soil.",
            "Found this plant in a meadow. It has tall stems and yellow flowers.",
            "This plant has fuzzy leaves and small pink flowers. Can anyone help?",
            "Found this plant in a rocky area. It has small, succulent leaves and no flowers.",
            "This plant has large, fan-shaped leaves and grows in clusters.",
            "Found this plant in a tropical garden. It has bright red flowers and glossy leaves.",
            "This plant has small, bell-shaped flowers and grows in shady areas.",
            "Found this plant in a wetland. It has long, grass-like leaves and small white flowers.",
        ];

        $plantImages = Storage::disk('public')->files('images/plants');
        $plantImages = array_slice($plantImages, 0, $numberOfPosts);

        foreach (range(0, $numberOfPosts - 1) as $i) {
            $imagePath = $plantImages[$i];
            $imageName = basename($imagePath);

            // Generate unique file name
            $extension = pathinfo($imageName, PATHINFO_EXTENSION);
            $uniqueImageName = Str::uuid() . '.' . $extension;

            // Source and destination paths
            $source = storage_path('app/public/images/plants/' . $imageName);
            $destination = storage_path('app/public/images/posts/' . $uniqueImageName);

            // Ensure destination directory exists
            if (!file_exists(dirname($destination))) {
                mkdir(dirname($destination), 0755, true);
            }

            // Copy instead of move
            copy($source, $destination);

            // Insert into DB
            DB::table('posts')->insert([
                'user_id' => $faker->randomElement($userIds),
                'type' => 'plant_identification',
                'title' => 'Unknown Plant Identification',
                'content' => $plantDescriptions[$i],
                'image' => $uniqueImageName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
