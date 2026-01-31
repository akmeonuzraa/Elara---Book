<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            
        ];

        foreach ($members as $member) {
            Member::create($member);
        }
    }
}