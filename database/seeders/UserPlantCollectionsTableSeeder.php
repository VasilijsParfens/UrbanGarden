<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Plant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPlantCollectionsTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $plants = Plant::all();
        $collectionTypes = ['have', 'had', 'want'];

        foreach ($users as $user) {
            // Track which plants have already been assigned to this user
            $usedPlantIds = [];

            foreach ($collectionTypes as $collectionType) {
                // Assign 3-5 plants to each collection type
                $numberOfPlants = rand(3, 5);

                // Get available plants that haven't been used for this user yet
                $availablePlants = $plants->whereNotIn('id', $usedPlantIds);

                // Shuffle the available plants to randomize the selection
                $availablePlants = $availablePlants->shuffle();

                // Assign the plants
                foreach ($availablePlants->take($numberOfPlants) as $plant) {
                    $usedPlantIds[] = $plant->id;

                    DB::table('user_plant_collections')->insert([
                        'user_id' => $user->id,
                        'plant_id' => $plant->id,
                        'collection_type' => $collectionType,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
