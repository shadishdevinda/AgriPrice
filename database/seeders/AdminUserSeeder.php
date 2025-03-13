<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or retrieve the 'system-admin' role
        $role = Role::firstOrCreate(['name' => 'system-admin']);

        // Create the admin user
        $adminUser = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'center_id' => null, // Update if you want to associate with a specific center
            'password' => Hash::make('password'), // Replace with a secure password
            'profile_photo_path' => 'images/default-user/user.png', // Default profile image path
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Assign the 'system-admin' role to the admin user
        $adminUser->assignRole($role);
    }
}
