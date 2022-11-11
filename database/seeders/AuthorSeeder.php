<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authors = [
            [
                'name' => 'Yaşar Kemal',
            ],
            [
                'name' => 'Oğuz Atay',
            ],
            [
                'name' => 'Sabahattin Ali',
            ],
            [
                'name' => 'John Steinback',
            ],
            [
                'name' => 'Jose Mauro De Vasconcelos',
            ],
            [
                'name' => 'Hakan Mengüç',
            ],
            [
                'name' => 'Stephen Hawking',
            ],
            [
                'name' => 'Uğur Koşar',
            ],
            [
                'name' => 'Mehmet Yıldız',
            ],
            [
                'name' => 'Mert Arık',
            ],
            [
                'name' => 'Marcus Aurelius',
            ],
            [
                'name' => 'Michel de Montaigne',
            ],
            [
                'name' => 'George Orwell',
            ],
            [
                'name' => 'Peyami Safa',
            ]
        ];

        foreach ($authors as $author) {
            \App\Models\Author::create($author);
        }
    }
}
