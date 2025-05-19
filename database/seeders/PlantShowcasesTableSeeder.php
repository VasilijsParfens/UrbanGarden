<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PlantShowcasesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Number of showcase posts to generate
        $numberOfShowcases = 20;

        // Get all user IDs from the users table
        $userIds = DB::table('users')->pluck('id');

        // Example showcase titles and corresponding images
        $showcaseData = [
            [
                'title' => "My Beautiful Monstera Deliciosa",
                'description' => "This Monstera Deliciosa has been growing so well! I love its split leaves.",
                'image' => 'monstera_deliciosa.jpg',
            ],
            [
                'title' => "Thriving Fiddle Leaf Fig",
                'description' => "My Fiddle Leaf Fig is thriving in bright, indirect light.",
                'image' => 'ficus_lyrata.jpg',
            ],
            [
                'title' => "Snake Plant in Full Bloom",
                'description' => "This Snake Plant is one of my favorites. It's so low-maintenance!",
                'image' => 'sansevieria_trifasciata.jpg',
            ],
            [
                'title' => "Peace Lily with Stunning Flowers",
                'description' => "My Peace Lily just bloomed, and the flowers are stunning.",
                'image' => 'spathiphyllum.jpg',
            ],
            [
                'title' => "Pothos Hanging Basket",
                'description' => "This Pothos is perfect for my hanging basket. It trails so beautifully.",
                'image' => 'epipremnum_aureum.jpg',
            ],
            [
                'title' => "Spider Plant with Spiderettes",
                'description' => "My Spider Plant produced so many spiderettes this year!",
                'image' => 'chlorophytum_comosum.jpg',
            ],
            [
                'title' => "Aloe Vera in My Kitchen",
                'description' => "I keep this Aloe Vera in my kitchen for its medicinal properties.",
                'image' => 'aloe_vera.jpg',
            ],
            [
                'title' => "Rubber Plant Growth Update",
                'description' => "My Rubber Plant has grown so much since I got it. I wipe its leaves regularly.",
                'image' => 'ficus_elastica.jpg',
            ],
            [
                'title' => "Boston Fern in My Bathroom",
                'description' => "This Boston Fern loves the humidity in my bathroom.",
                'image' => 'nephrolepis_exaltata.jpg',
            ],
            [
                'title' => "ZZ Plant Thriving in Low Light",
                'description' => "My ZZ Plant is thriving in low light. It's such a resilient plant!",
                'image' => 'zamioculcas_zamiifolia.jpg',
            ],
            [
                'title' => "Calathea with Vibrant Leaves",
                'description' => "The leaves on this Calathea are so vibrant and patterned.",
                'image' => 'calathea_lancifolia.jpg',
            ],
            [
                'title' => "Jade Plant in a Ceramic Pot",
                'description' => "This Jade Plant is one of my oldest plants. It's a symbol of good luck!",
                'image' => 'crassula_ovata.jpg',
            ],
            [
                'title' => "Philodendron Climbing the Wall",
                'description' => "My Philodendron is climbing up the wall. It's such a fast grower!",
                'image' => 'philodendron_hederaceum.jpg',
            ],
            [
                'title' => "Bird of Paradise in My Living Room",
                'description' => "This Bird of Paradise adds a tropical vibe to my living room.",
                'image' => 'codiaeum_variegatum.jpg',
            ],
            [
                'title' => "Chinese Money Plant Collection",
                'description' => "I love my collection of Chinese Money Plants. They're so unique!",
                'image' => 'peperomia_obtusifolia.jpg',
            ],
            [
                'title' => "Dracaena in My Office",
                'description' => "This Dracaena is perfect for my office. It tolerates low light well.",
                'image' => 'dracaena_marginata.jpg',
            ],
            [
                'title' => "English Ivy on My Balcony",
                'description' => "My English Ivy is thriving on my balcony. It's so lush!",
                'image' => 'hedera_helix.jpg',
            ],
            [
                'title' => "Lucky Bamboo Arrangement",
                'description' => "This Lucky Bamboo arrangement is a symbol of good fortune.",
                'image' => 'bambusoideae.jpg',
            ],
            [
                'title' => "Orchid Blooming Beautifully",
                'description' => "My Orchid is blooming beautifully. The flowers last for months!",
                'image' => 'phalaenopsis.jpg',
            ],
            [
                'title' => "Ponytail Palm in a Sunny Spot",
                'description' => "This Ponytail Palm loves the sunny spot by my window.",
                'image' => 'bromeliaceae.jpg',
            ],
        ];

        $plantImages = Storage::disk('public')->files('images/plants');
        $plantImages = array_slice($plantImages, 0, $numberOfShowcases);

        foreach (range(0, $numberOfShowcases - 1) as $i) {
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
                'type' => 'showcase',
                'title' => $showcaseData[$i]['title'],
                'content' => $showcaseData[$i]['description'],
                'image' => $uniqueImageName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
