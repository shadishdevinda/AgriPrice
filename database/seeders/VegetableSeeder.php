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
                'name' => 'Carrot - කැරට් - கேரட்',
                'description' => 'A root vegetable, rich in beta-carotene and fiber. - මූල එළවළු, බීටා-කැරොටීන් සහ තන්තු වලින් පොහොසත්. - ஒரு வேர் காய்கறி, பீட்டா-கேரட்டின் மற்றும் நார்ச்சத்து நிறைந்தது.',
                'image' => 'images/default-vegetable/vegetables.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tomato - තක්කාලි - தக்காளி',
                'description' => 'A red fruit often used as a vegetable, rich in vitamins and antioxidants. - රතු පළතුරක් බොහෝ විට එළවළුවක් ලෙස භාවිතා කරයි, විටමින් සහ ප්‍රතිඔක්සිකාරක වලින් පොහොසත්. - ஒரு சிவப்பு பழம், பெரும்பாலும் காய்கறியாக பயன்படுத்தப்படுகிறது, வைட்டமின்கள் மற்றும் ஆன்டிஆக்ஸிடன்ட்கள் நிறைந்தது.',
                'image' => 'images/default-vegetable/vegetables.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Potato - අල - உருளைக்கிழங்கு',
                'description' => 'A starchy tuber, a staple food in many cuisines. - පිෂ්ට සහිත කඳ, බොහෝ ආහාර වේල්වල ප්‍රධාන ආහාරයකි. - ஒரு மாப்பொருள் கிழங்கு, பல சமையல்களில் முக்கிய உணவு.',
                'image' => 'images/default-vegetable/vegetables.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cucumber - පිපිංග - வெள்ளரிக்காய்',
                'description' => 'A refreshing vegetable, often used in salads. - සැන්දෑවක් එළවළුවක්, බොහෝ විට සලඩ් වල භාවිතා කරයි. - ஒரு புத்துணர்ச்சி தரும் காய்கறி, பெரும்பாலும் சாலட்களில் பயன்படுத்தப்படுகிறது.',
                'image' => 'images/default-vegetable/vegetables.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Broccoli - බ්‍රොකලි - ப்ரோக்கோலி',
                'description' => 'A green vegetable, rich in vitamins and antioxidants. - හරිත එළවළුවක්, විටමින් සහ ප්‍රතිඔක්සිකාරක වලින් පොහොසත්. - ஒரு பச்சை காய்கறி, வைட்டமின்கள் மற்றும் ஆன்டிஆக்ஸிடன்ட்கள் நிறைந்தது.',
                'image' => 'images/default-vegetable/vegetables.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Spinach - නිවිතිබත් - கீரை',
                'description' => 'A leafy green vegetable, rich in iron and vitamins. - කොළ සහිත හරිත එළවළුවක්, යකඩ සහ විටමින් වලින් පොහොසත්. - ஒரு இலை காய்கறி, இரும்பு மற்றும் வைட்டமின்கள் நிறைந்தது.',
                'image' => 'images/default-vegetable/vegetables.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bell Pepper - රතු මිරිස් - பெல் மிளகாய்',
                'description' => 'A colorful vegetable, rich in vitamin C and antioxidants. - වර්ණවත් එළවළුවක්, විටමින් C සහ ප්‍රතිඔක්සිකාරක වලින් පොහොසත්. - ஒரு வண்ணமயமான காய்கறி, வைட்டமின் C மற்றும் ஆன்டிஆக்ஸிடன்ட்கள் நிறைந்தது.',
                'image' => 'images/default-vegetable/vegetables.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Onion - ලූණු - வெங்காயம்',
                'description' => 'A pungent vegetable, used as a base in many dishes. - තියුණු එළවළුවක්, බොහෝ අවන්හල් වල පදනමක් ලෙස භාවිතා කරයි. - ஒரு காரமான காய்கறி, பல உணவுகளில் அடிப்படையாக பயன்படுத்தப்படுகிறது.',
                'image' => 'images/default-vegetable/vegetables.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Garlic - සුදුළූණු - பூண்டு',
                'description' => 'A flavorful vegetable, known for its health benefits. - සුවඳ විලවුන් සහිත එළවළුවක්, සෞඛ්‍ය ප්‍රතිලාභ සඳහා ප්‍රසිද්ධය. - ஒரு சுவையான காய்கறி, அதன் ஆரோக்கிய நன்மைகளுக்கு பெயர் பெற்றது.',
                'image' => 'images/default-vegetable/vegetables.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cabbage - ගෝවා - முட்டைக்கோஸ்',
                'description' => 'A leafy vegetable, often used in salads and stir-fries. - කොළ සහිත එළවළුවක්, බොහෝ විට සලඩ් සහ ව්‍යංජන වල භාවිතා කරයි. - ஒரு இலை காய்கறி, பெரும்பாலும் சாலட்கள் மற்றும் வறுவல்களில் பயன்படுத்தப்படுகிறது.',
                'image' => 'images/default-vegetable/vegetables.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert the vegetables into the table
        DB::table('vegetable')->insert($vegetables);
    }
}
