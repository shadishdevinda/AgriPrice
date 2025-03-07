<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FruitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fruits = [
            [
                'name' => 'Apple',
                'description' => 'A sweet and crunchy fruit, rich in fiber and vitamins.',
                'image' => 'images/default-fruit/fruits.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Banana',
                'description' => 'A tropical fruit, rich in potassium and energy.',
                'image' => 'images/default-fruit/fruits.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Orange',
                'description' => 'A citrus fruit, rich in vitamin C and antioxidants.',
                'image' => 'images/default-fruit/fruits.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mango',
                'description' => 'A tropical fruit, known for its sweet and juicy flavor.',
                'image' => 'images/default-fruit/fruits.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pineapple',
                'description' => 'A tropical fruit with a sweet and tangy taste.',
                'image' => 'images/default-fruit/fruits.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Strawberry',
                'description' => 'A small, red fruit, rich in vitamin C and antioxidants.',
                'image' => 'images/default-fruit/fruits.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Grapes',
                'description' => 'Small, sweet fruits, often used to make wine.',
                'image' => 'images/default-fruit/fruits.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Watermelon',
                'description' => 'A large, juicy fruit, perfect for hot weather.',
                'image' => 'images/default-fruit/fruits.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Papaya',
                'description' => 'A tropical fruit, rich in vitamins and digestive enzymes.',
                'image' => 'images/default-fruit/fruits.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kiwi',
                'description' => 'A small, green fruit, rich in vitamin C and fiber.',
                'image' => 'images/default-fruit/fruits.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert the fruits into the table
        DB::table('fruit')->insert($fruits);
    }
}
