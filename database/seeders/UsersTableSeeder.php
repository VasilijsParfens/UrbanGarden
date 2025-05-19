<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Create 1000 random users
        $users = User::factory(1000)->create();

        // Assign and move profile pictures
        $this->assignProfilePictures($users);

        // Create specific admin user
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
            'is_admin' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create specific non-admin user
        DB::table('users')->insert([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => bcrypt('user123'),
            'is_admin' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    protected function assignProfilePictures($users)
    {
        $sourceFolder = storage_path('app/public/images/profile_pictures');
        $destinationFolder = storage_path('app/public/images/assigned_profile_pictures');

        // Ensure source folder exists
        if (!File::exists($sourceFolder)) {
            $this->command->error("Mape '$sourceFolder' neeksistē.");
            return;
        }

        // Ensure destination folder exists or create it
        if (!File::exists($destinationFolder)) {
            File::makeDirectory($destinationFolder, 0755, true);
        }

        // Get all image files from the source
        $files = File::files($sourceFolder);

        if (empty($files)) {
            $this->command->error('Mape ir tukša! Neviena profila bilde netika atrasta.');
            return;
        }

        shuffle($files);

        foreach ($users as $index => $user) {
            $randomFile = $files[$index % count($files)];
            $extension = $randomFile->getExtension();

            // Sanitize username for filename
            $sanitizedUsername = Str::slug($user->name);
            $date = now()->format('Ymd_His');
            $newFileName = "{$sanitizedUsername}_{$date}.{$extension}";

            $destinationPath = $destinationFolder . '/' . $newFileName;

            // Copy file to new destination with new name
            File::copy($randomFile->getRealPath(), $destinationPath);

            // Save relative path to DB (relative to public/storage)
            $user->profile_picture = $newFileName;
            $user->save();
        }

        $this->command->info('Profila bildes piešķirtas un pārvietotas.');
    }
}
