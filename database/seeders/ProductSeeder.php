<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'category_id' => 1,
                'title' => 'İnce Memed',
                'author_id' => 1,
                'price' => 48.75,
                'stock_quantity' => 10,
            ],
            [
                'category_id' => 1,
                'title' => 'Tutunamayanlar',
                'author_id' => 2,
                'price' => 90.35,
                'stock_quantity' => 20,
            ],
            [
                'category_id' => 1,
                'title' => 'Kürk Mantolu Madonna',
                'author_id' => 3,
                'price' => 9.1,
                'stock_quantity' => 4,
            ],
            [
                'category_id' => 1,
                'title' => 'Fareler ve İnsanlar',
                'author_id' => 4,
                'price' => 35.75,
                'stock_quantity' => 8,
            ],
            [
                'category_id' => 1,
                'title' => 'Şeker Portakalı',
                'author_id' => 5,
                'price' => 33.75,
                'stock_quantity' => 1,
            ],
            [
                'category_id' => 2,
                'title' => 'Sen Yola Çık Yol Sana Görünür',
                'author_id' => 6,
                'price' => 28.5,
                'stock_quantity' => 7,
            ],
            [
                'category_id' => 3,
                'title' => 'Kara Delikler',
                'author_id' => 7,
                'price' => 39.55,
                'stock_quantity' => 2,
            ],
            [
                'category_id' => 4,
                'title' => 'Allah De Ötesini Bırak',
                'author_id' => 8,
                'price' => 39.60,
                'stock_quantity' => 18,
            ],
            [
                'category_id' => 4,
                'title' => 'Aşk 5 Vakittir',
                'author_id' => 9,
                'price' => 42,
                'stock_quantity' => 9,
            ],
            [
                'category_id' => 6,
                'title' => 'Benim Zürafam Uçabilir',
                'author_id' => 10,
                'price' => 27.3,
                'stock_quantity' => 12,
            ],
            [
                'category_id' => 1,
                'title' => 'Kuyucaklı Yusuf',
                'author_id' => 3,
                'price' => 10.4,
                'stock_quantity' => 2,
            ],
            [
                'category_id' => 5,
                'title' => 'Kamyon - Seçme Öyküler',
                'author_id' => 3,
                'price' => 9.75,
                'stock_quantity' => 9,
            ],
            [
                'category_id' => 13,
                'title' => 'Kendime Düşünceler',
                'author_id' => 11,
                'price' => 14.40,
                'stock_quantity' => 1,
            ],
            [
                'category_id' => 13,
                'title' => 'Denemeler - Hasan Ali Yücel Klasikleri',
                'author_id' => 12,
                'price' => 24,
                'stock_quantity' => 4,
            ],
            [
                'category_id' => 1,
                'title' => 'Animal Farm',
                'author_id' => 13,
                'price' => 17.50,
                'stock_quantity' => 4,
            ],
            [
                'category_id' => 1,
                'title' => 'Dokuzuncu Hariciye Koğuşu',
                'author_id' => 14,
                'price' => 18.50,
                'stock_quantity' => 0,
            ],
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}
