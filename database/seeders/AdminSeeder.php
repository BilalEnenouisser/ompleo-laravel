<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::firstOrCreate(
            ['email' => 'admin@ompleo.com'],
            [
                'name' => 'Admin Ompleo',
                'password' => bcrypt('password'),
                'user_type' => 'admin',
                'email_verified_at' => now(),
            ]
        );
    }
}
