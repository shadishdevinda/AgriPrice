<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VegetableAdviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vegetableAdvice = [
            [
                'description' => 'Carrots grow best in loose, sandy soil. Ensure the soil is free of stones and debris. Plant seeds 1/4 inch deep and 2 inches apart. Water regularly to keep the soil moist but not waterlogged.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Tomatoes require well-drained soil and plenty of sunlight. Use stakes or cages to support the plants as they grow. Water at the base to avoid wetting the leaves, which can lead to diseases.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Potatoes thrive in cool climates. Plant seed potatoes in trenches 12 inches apart and cover with soil. As the plants grow, mound soil around the stems to encourage tuber development.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Cucumbers need warm soil and plenty of sunlight. Plant seeds 1 inch deep and 36 inches apart. Provide a trellis for the vines to climb, which helps improve air circulation and reduces disease.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Broccoli grows best in cool weather. Plant seedlings 18 inches apart in well-drained soil. Keep the soil consistently moist and fertilize every 3-4 weeks for optimal growth.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Spinach prefers cool weather and partial shade. Plant seeds 1/2 inch deep and 2 inches apart. Water regularly and harvest leaves when they are young and tender for the best flavor.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Bell peppers need warm soil and full sunlight. Plant seedlings 18 inches apart in well-drained soil. Water deeply once a week and mulch around the plants to retain moisture.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Onions grow best in well-drained soil with plenty of organic matter. Plant sets 1 inch deep and 4 inches apart. Water regularly and keep the area weed-free for optimal growth.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Garlic prefers well-drained soil and full sunlight. Plant cloves 2 inches deep and 6 inches apart. Water sparingly, as garlic does not require much moisture once established.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Cabbage grows best in cool weather. Plant seedlings 12 inches apart in well-drained soil. Water regularly and protect the plants from pests like cabbage worms.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert the vegetable advice into the table
        DB::table('vegetable_advice')->insert($vegetableAdvice);
    }
}
