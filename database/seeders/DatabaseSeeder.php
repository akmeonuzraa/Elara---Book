<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            GenreSeeder::class,
            StatusSeeder::class,
            AuthorSeeder::class,
            PublisherSeeder::class,
            MemberSeeder::class,
            BookSeeder::class,
            MassiveDataSeeder::class,
        ]);
    }
}
