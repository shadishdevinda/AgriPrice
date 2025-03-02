<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EconomicCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $economicCenters = [
            [
                'id' => $this->generateCustomId('DB'), // Generate custom ID for Dambulla
                'center_name' => 'Dambulla Dedicated Economic Centre',
                'contact_number' => '+94 66 222 2222', // Example contact number
                'center_location' => 'Dambulla, Sri Lanka',
                'profile_photo_path' => 'images/default-center/economic-center.jpg', // Default profile image path
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => $this->generateCustomId('TB'), // Generate custom ID for Thambuttegama
                'center_name' => 'Thambuttegama Dedicated Economic Centre',
                'contact_number' => '+94 77 333 3333', // Example contact number
                'center_location' => 'Thambuttegama, Sri Lanka',
                'profile_photo_path' => 'images/default-center/economic-center.jpg', // Default profile image path
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => $this->generateCustomId('WL'), // Generate custom ID for Welisara
                'center_name' => 'Welisara Dedicated Economic Centre',
                'contact_number' => '+94 11 444 4444', // Example contact number
                'center_location' => 'Welisara, Sri Lanka',
                'profile_photo_path' => 'images/default-center/economic-center.jpg', // Default profile image path
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => $this->generateCustomId('NP'), // Generate custom ID for Narahenpita
                'center_name' => 'Narahenpita Economic Centre',
                'contact_number' => '+94 11 555 5555', // Example contact number
                'center_location' => 'Narahenpita, Sri Lanka',
                'profile_photo_path' => 'images/default-center/economic-center.jpg', // Default profile image path
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => $this->generateCustomId('RT'), // Generate custom ID for Rathmalana
                'center_name' => 'Rathmalana Economic Centre',
                'contact_number' => '+94 11 666 6666', // Example contact number
                'center_location' => 'Rathmalana, Sri Lanka',
                'profile_photo_path' => 'images/default-center/economic-center.jpg', // Default profile image path
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert the economic centers into the table
        DB::table('economic_center')->insert($economicCenters);
    }

    /**
     * Generate a custom ID for the economic center.
     *
     * @param string $prefix The prefix for the ID (e.g., 'DB' for Dambulla).
     * @return string The generated custom ID.
     */
    private function generateCustomId(string $prefix): string
    {
        // Generate a random 6-digit number
        $randomNumber = mt_rand(100000, 999999);

        // Combine the prefix and random number to create the custom ID
        return $prefix . '-' . $randomNumber;
    }
}
