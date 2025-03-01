<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com', // Corrected the typo in the email (gamil -> gmail)
            'user_type' => 'system-user',
            'center_id' => null, // Update if you want to associate with a specific center
            'password' => Hash::make('password'), // Replace with a secure password
            'profile_photo_path' => 'images/default-user/user.png', // Default profile image path
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
