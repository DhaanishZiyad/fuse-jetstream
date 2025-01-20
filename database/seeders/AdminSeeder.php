<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // Import the Hash facade

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // Ensure the seeder doesn't create duplicates
            [
                'name' => 'Admin',
                'password' => Hash::make('password'), // Replace 'admin123' with your desired password
                'role' => 'admin',
            ]
        );
    }
}
