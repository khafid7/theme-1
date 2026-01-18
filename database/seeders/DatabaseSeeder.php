<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Panggil Seeder Undangan Kamu Disini
        $this->call([
            InvitationSeeder::class,
        ]);
    }
}