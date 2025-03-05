<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FruitAdviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fruitAdvice = [
            [
                'description' => 'Apples grow best in well-drained soil with full sunlight. Plant trees 15-20 feet apart. Prune annually to encourage healthy growth and fruit production.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Bananas thrive in tropical climates with rich, well-drained soil. Plant suckers 10 feet apart. Water regularly and mulch around the base to retain moisture.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Oranges require well-drained soil and full sunlight. Plant trees 20 feet apart. Water deeply once a week and fertilize regularly for optimal fruit production.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Mangoes grow best in warm climates with well-drained soil. Plant trees 30 feet apart. Water regularly during the growing season and prune to maintain shape.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Pineapples thrive in sandy, well-drained soil. Plant crowns 12 inches apart. Water sparingly, as pineapples are drought-tolerant once established.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Strawberries grow best in well-drained soil with full sunlight. Plant runners 12 inches apart. Mulch around the plants to retain moisture and prevent weeds.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Grapes require well-drained soil and full sunlight. Plant vines 8 feet apart. Provide a trellis for support and prune annually to encourage fruit production.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Watermelons thrive in warm climates with sandy, well-drained soil. Plant seeds 6 feet apart. Water deeply once a week and mulch to retain moisture.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Papayas grow best in warm climates with well-drained soil. Plant seeds 8 feet apart. Water regularly and protect the plants from strong winds.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => 'Kiwis require well-drained soil and full sunlight. Plant vines 10 feet apart. Provide a sturdy trellis for support and prune annually to encourage growth.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert the fruit advice into the table
        DB::table('fruit_advice')->insert($fruitAdvice);
    }
}
