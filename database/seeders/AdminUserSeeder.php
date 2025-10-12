<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        \App\Models\User::create([
            'name' => 'Admin OMPLEO',
            'email' => 'admin@ompleo.dz',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'user_type' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create Test Recruiter
        \App\Models\User::create([
            'name' => 'Ahmed Recruteur',
            'email' => 'recruiter@ompleo.dz',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'user_type' => 'recruiter',
            'email_verified_at' => now(),
        ]);

        // Create Test Candidate
        \App\Models\User::create([
            'name' => 'Fatima Candidate',
            'email' => 'candidate@ompleo.dz',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'user_type' => 'candidate',
            'email_verified_at' => now(),
        ]);
    }
}
