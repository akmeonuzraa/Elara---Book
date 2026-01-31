<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    public function run(): void
    {
        $publishers = [
            ['name' => 'Penguin Random House', 'email' => 'info@penguinrandomhouse.com'],
            ['name' => 'HarperCollins', 'email' => 'info@harpercollins.com'],
            ['name' => 'Simon & Schuster', 'email' => 'info@simonandschuster.com'],
            ['name' => 'Hachette Book Group', 'email' => 'info@hachette.com'],
            ['name' => 'Macmillan Publishers', 'email' => 'info@macmillan.com'],
        ];

        foreach ($publishers as $publisher) {
            Publisher::create($publisher);
        }
    }
}