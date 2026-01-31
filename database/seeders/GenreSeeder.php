<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            ['name' => 'Fiction', 'description' => 'Fictional literature'],
            ['name' => 'Non-Fiction', 'description' => 'Factual books'],
            ['name' => 'Science', 'description' => 'Scientific books'],
            ['name' => 'History', 'description' => 'Historical books'],
            ['name' => 'Biography', 'description' => 'Life stories'],
            ['name' => 'Technology', 'description' => 'Tech and IT books'],
            ['name' => 'Romance', 'description' => 'Romantic novels'],
            ['name' => 'Mystery', 'description' => 'Mystery and thriller'],
            ['name' => 'Fantasy', 'description' => 'Fantasy literature'],
            ['name' => 'Self-Help', 'description' => 'Personal development'],
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
}