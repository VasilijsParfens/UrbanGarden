<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            PlantsTableSeeder::class,
            TipsTableSeeder::class,
            QuestionsTableSeeder::class,
            UserPlantCollectionsTableSeeder::class,
            FollowersTableSeeder::class,
            PlantIdentificationsTableSeeder::class,
            PlantShowcasesTableSeeder::class,
            PlantCommentsSeeder::class,
            CommentsTableSeeder::class,
            CommentVotesTableSeeder::class,
        ]);
    }
}
