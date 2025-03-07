<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VegetableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vegetables = [
            [
                'name' => 'Carrot',
                'description' => 'A root vegetable, rich in beta-carotene and fiber.',
                'image' => 'images/default-vegetable/vegetables.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tomato',
                'description' => 'A red fruit often used as a vegetable, rich in vitamins and antioxidants.',
                'image' => 'images/default-vegetable/vegetables.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Potato',
                'description' => 'A starchy tuber, a staple food in many cuisines.',
                'image' => 'images/default-vegetable/vegetables.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cucumber',
                'description' => 'A refreshing vegetable, often used in salads.',
                'image' => 'images/default-vegetable/vegetables.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Broccoli',
                'description' => 'A green vegetable, rich in vitamins and antioxidants.',
                'image' => 'images/default-vegetable/vegetables.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Spinach',
                'description' => 'A leafy green vegetable, rich in iron and vitamins.',
                'image' => 'images/default-vegetable/vegetables.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bell Pepper',
                'description' => 'A colorful vegetable, rich in vitamin C and antioxidants.',
                'image' => 'images/default-vegetable/vegetables.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Onion',
                'description' => 'A pungent vegetable, used as a base in many dishes.',
                'image' => 'images/default-vegetable/vegetables.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Garlic',
                'description' => 'A flavorful vegetable, known for its health benefits.',
                'image' => 'images/default-vegetable/vegetables.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cabbage',
                'description' => 'A leafy vegetable, often used in salads and stir-fries.',
                'image' => 'images/default-vegetable/vegetables.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert the vegetables into the table
        DB::table('vegetable')->insert($vegetables);
    }
}
