<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DemoUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create demo users
        $users = [
            [
                'name' => 'Demo Candidate',
                'email' => 'candidate@ompleo.com',
                'password' => Hash::make('password'),
                'user_type' => 'candidate',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Demo Recruiter',
                'email' => 'recruiter@ompleo.com',
                'password' => Hash::make('password'),
                'user_type' => 'recruiter',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Demo Admin',
                'email' => 'admin@ompleo.com',
                'password' => Hash::make('password'),
                'user_type' => 'admin',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}