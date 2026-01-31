<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            ['name' => 'J.K. Rowling', 'nationality' => 'British', 'birth_date' => '1965-07-31'],
            ['name' => 'Stephen King', 'nationality' => 'American', 'birth_date' => '1947-09-21'],
            ['name' => 'Agatha Christie', 'nationality' => 'British', 'birth_date' => '1890-09-15'],
            ['name' => 'Dan Brown', 'nationality' => 'American', 'birth_date' => '1964-06-22'],
            ['name' => 'Paulo Coelho', 'nationality' => 'Brazilian', 'birth_date' => '1947-08-24'],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}