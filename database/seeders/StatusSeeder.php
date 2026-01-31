<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            ['name' => 'Available', 'description' => 'Book is available for borrowing'],
            ['name' => 'Borrowed', 'description' => 'Book is currently borrowed'],
            ['name' => 'Reserved', 'description' => 'Book is reserved'],
            ['name' => 'Maintenance', 'description' => 'Book under maintenance'],
            ['name' => 'Lost', 'description' => 'Book is lost'],
            ['name' => 'Damaged', 'description' => 'Book is damaged'],
        ];

        foreach ($statuses as $status) {
            Status::create($status);
        }
    }
}