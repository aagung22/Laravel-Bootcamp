<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'name' => 'Roti Tawar Gandum',
                'category' => 'Roti Klasik',
                'price' => 20000,
                'description' => 'Roti tawar lembut kaya serat yang terbuat dari biji gandum utuh, cocok untuk sajian sehat harian.',
                'image' => 'assets/images/menu/Roti_Tawar_Gandum.jpg',
            ],
            [
                'name' => 'Roti Sobek Cokelat Keju',
                'category' => 'Roti Klasik',
                'price' => 18000,
                'description' => 'Roti empuk bertekstur lembut dengan isian paduan cokelat lumer dan keju parut gurih di dalamnya.',
                'image' => 'assets/images/menu/Roti_Sobek.jpg',
            ],
            [
                'name' => 'Roti Sisir Mentega',
                'category' => 'Roti Klasik',
                'price' => 12000,
                'description' => 'Roti manis gaya tradisional yang diolesi campuran mentega dan gula halus di setiap lembarannya.',
                'image' => 'assets/images/menu/Roti_Sisir.jpg',
            ],
            [
                'name' => 'Roti Bun Kismis',
                'category' => 'Roti Klasik',
                'price' => 9000,
                'description' => 'Roti manis beraroma kayu manis ringan dengan taburan kismis segar yang memberikan sensasi asam-manis alami.',
                'image' => 'assets/images/menu/Roti_Kismis.jpg',
            ],
            [
                'name' => 'Donat Kampung Gula Halus',
                'category' => 'Donat',
                'price' => 6000,
                'description' => 'Donat kentang klasik bertekstur sangat empuk dengan balutan gula donat dingin yang manis dan bernostalgia.',
                'image' => 'assets/images/menu/Donat_Kampung.jpg',
            ],
            [
                'name' => 'Donat Glaze Vanilla',
                'category' => 'Donat',
                'price' => 9000,
                'description' => 'Donat dengan lapisan gula glaze vanilla transparan yang renyah di luar dan lembut di dalam.',
                'image' => 'assets/images/menu/Donat_Vanila.jpg',
            ],
            [
                'name' => 'Donat Cokelat Meses',
                'category' => 'Donat',
                'price' => 8500,
                'description' => 'Donat dengan topping krim cokelat pekat dan taburan meses cokelat melimpah.',
                'image' => 'assets/images/menu/Donat_Coklat.jpg',
            ],
            [
                'name' => 'Butter Croissant',
                'category' => 'Pastry',
                'price' => 18000,
                'description' => 'Pastry berlapis khas Prancis yang flaky (renyah beremah) dan kaya aroma butter.',
                'image' => 'assets/images/menu/Croissant.jpg',
            ],
            [
                'name' => 'Pain au Chocolat',
                'category' => 'Pastry',
                'price' => 17000,
                'description' => 'Pastry lipat renyah beraroma mentega dengan isian batangan dark chocolate premium.',
                'image' => 'assets/images/menu/Pain_Au.jpg',
            ],
            [
                'name' => 'Cinnamon Roll',
                'category' => 'Pastry',
                'price' => 18000,
                'description' => 'Pastry gulung rempah kayu manis dengan lapisan cream cheese glaze gurih manis.',
                'image' => 'assets/images/menu/Cinnamon.jpg',
            ],
            [
                'name' => 'Fruit Danish',
                'category' => 'Pastry',
                'price' => 20000,
                'description' => 'Pastry renyah berisikan vanilla pastry cream dan topping buah-buahan segar.',
                'image' => 'assets/images/menu/Fruit.jpg',
            ],
        ];

        foreach ($items as $item) {
            Menu::create($item);
        }
    }
}
