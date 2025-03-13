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
                'name' => 'Apple - ඇපල් - ஆப்பிள்',
                'description' => 'A sweet and crunchy fruit, rich in fiber and vitamins. - මිහිරි හා කටුක පළතුරක්, තන්තු සහ විටමින් වලින් පොහොසත්. - ஒரு இனிப்பு மற்றும் மிருதுவான பழம், நார்ச்சத்து மற்றும் வைட்டமின்கள் நிறைந்தது.',
                'image' => 'images/default-fruit/fruits.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Banana - කෙසෙල් - வாழைப்பழம்',
                'description' => 'A tropical fruit, rich in potassium and energy. - නිවර්තන පළතුරක්, පොටෑසියම් සහ ශක්තියෙන් පොහොසත්. - ஒரு வெப்பமண்டல பழம், பொட்டாசியம் மற்றும் ஆற்றல் நிறைந்தது.',
                'image' => 'images/default-fruit/fruits.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Orange - තැඹිලි - ஆரஞ்சு',
                'description' => 'A citrus fruit, rich in vitamin C and antioxidants. - සිට්රස් පළතුරක්, විටමින් C සහ ප්‍රතිඔක්සිකාරක වලින් පොහොසත්. - ஒரு சிட்ரஸ் பழம், வைட்டமின் C மற்றும் ஆன்டிஆக்ஸிடன்ட்கள் நிறைந்தது.',
                'image' => 'images/default-fruit/fruits.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mango - අඹ - மாம்பழம்',
                'description' => 'A tropical fruit, known for its sweet and juicy flavor. - නිවර්තන පළතුරක්, එහි මිහිරි හා රසවත් රසය සඳහා ප්‍රසිද්ධය. - ஒரு வெப்பமண்டல பழம், அதன் இனிப்பு மற்றும் சாறு நிறைந்த சுவைக்கு பெயர் பெற்றது.',
                'image' => 'images/default-fruit/fruits.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pineapple - අන්නාසි - அன்னாசிப் பழம்',
                'description' => 'A tropical fruit with a sweet and tangy taste. - මිහිරි හා රසවත් රසයක් සහිත නිවර්තන පළතුරක්. - ஒரு வெப்பமண்டல பழம், இனிப்பு மற்றும் புளிப்பு சுவையுடன்.',
                'image' => 'images/default-fruit/fruits.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Strawberry - ස්ට්‍රෝබෙරි - ஸ்ட்ராபெரி',
                'description' => 'A small, red fruit, rich in vitamin C and antioxidants. - කුඩා, රතු පළතුරක්, විටමින් C සහ ප්‍රතිඔක්සිකාරක වලින් පොහොසත්. - ஒரு சிறிய, சிவப்பு பழம், வைட்டமின் C மற்றும் ஆன்டிஆக்ஸிடன்ட்கள் நிறைந்தது.',
                'image' => 'images/default-fruit/fruits.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Grapes - මිදි - திராட்சை',
                'description' => 'Small, sweet fruits, often used to make wine. - කුඩා, මිහිරි පළතුරු, බොහෝ විට වයින් සෑදීමට භාවිතා කරයි. - சிறிய, இனிப்பு பழங்கள், பெரும்பாலும் மது தயாரிக்க பயன்படுத்தப்படுகின்றன.',
                'image' => 'images/default-fruit/fruits.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Watermelon - කොමඩු - தர்பூசணி',
                'description' => 'A large, juicy fruit, perfect for hot weather. - විශාල, ජූසි පළතුරක්, උණුසුම් කාලගුණය සඳහා පරිපූර්ණයි. - ஒரு பெரிய, சாறு நிறைந்த பழம், வெப்பமான வானிலைக்கு சிறந்தது.',
                'image' => 'images/default-fruit/fruits.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Papaya - ගස්ලබු - பப்பாளி',
                'description' => 'A tropical fruit, rich in vitamins and digestive enzymes. - නිවර්තන පළතුරක්, විටමින් සහ ජීර්ණ එන්සයිම වලින් පොහොසත්. - ஒரு வெப்பமண்டல பழம், வைட்டமின்கள் மற்றும் செரிமான நொதிகள் நிறைந்தது.',
                'image' => 'images/default-fruit/fruits.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kiwi - කිවි - கிவி',
                'description' => 'A small, green fruit, rich in vitamin C and fiber. - කුඩා, හරිත පළතුරක්, විටමින් C සහ තන්තු වලින් පොහොසත්. - ஒரு சிறிய, பச்சை பழம், வைட்டமின் C மற்றும் நார்ச்சத்து நிறைந்தது.',
                'image' => 'images/default-fruit/fruits.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert the fruits into the table
        DB::table('fruit')->insert($fruits);
    }
}
