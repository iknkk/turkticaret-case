<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'title' => 'Roman',
            ],
            [
                'title' => 'Kişisel Gelişim',
            ],
            [
                'title' => 'Bilim',
            ],
            [
                'title' => 'Din Tasavvuf',
            ],
            [
                'title' => 'Öykü',
            ],
            [
                'title' => 'Felsefe',
            ],
            [
                'title' => 'Çocuk ve Gençlik',
            ]
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
